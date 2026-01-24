# Livewire 3.x - Forms & Validation

> Complete form handling, validation en file uploads
> **Pad**: `/docs/livewire/livewire-forms.md`

---

## 📝 Basic Form

```php
<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    public $title = '';
    public $content = '';
    
    public function save()
    {
        Post::create($this->only(['title', 'content']));
        
        session()->flash('status', 'Post created!');
        return $this->redirect('/posts');
    }
    
    public function render()
    {
        return view('livewire.create-post');
    }
}
```

```blade
<form wire:submit="save">
    <input type="text" wire:model="title">
    <textarea wire:model="content"></textarea>
    
    <button type="submit">Save</button>
    
    {{-- Loading indicator --}}
    <span wire:loading wire:target="save">Saving...</span>
</form>
```

---

## ✅ Validation

### Basis Validatie

```php
use Livewire\Attributes\Validate;

class CreatePost extends Component
{
    #[Validate('required|min:5')]
    public $title = '';
    
    #[Validate('required|min:10|max:500')]
    public $content = '';
    
    public function save()
    {
        $this->validate();  // Validates all #[Validate] properties
        
        Post::create($this->only(['title', 'content']));
        return $this->redirect('/posts');
    }
}
```

```blade
<form wire:submit="save">
    <div>
        <input wire:model="title">
        @error('title') 
            <span class="text-red-500">{{ $message }}</span> 
        @enderror
    </div>
    
    <div>
        <textarea wire:model="content"></textarea>
        @error('content') 
            <span class="text-red-500">{{ $message }}</span> 
        @enderror
    </div>
    
    <button type="submit">Save</button>
</form>
```

### Real-time Validation

```blade
{{-- Validates on blur --}}
<input wire:model.blur="email">
@error('email') <span>{{ $message }}</span> @enderror

{{-- Validates live (tijdens typen) --}}
<input wire:model.live="username">
@error('username') <span>{{ $message }}</span> @enderror
```

### Custom Error Messages

```php
use Livewire\Attributes\Validate;

class CreatePost extends Component
{
    #[Validate('required|min:5', message: 'De titel is verplicht en moet minimaal 5 tekens zijn.')]
    public $title = '';
    
    #[Validate('required', message: [
        'required' => 'Content is verplicht.',
        'min' => 'Content moet minimaal :min tekens zijn.'
    ])]
    public $content = '';
}
```

### Advanced Validation with Rules

```php
use Illuminate\Validation\Rule;

class UpdatePost extends Component
{
    public ?Post $post;
    
    #[Validate]
    public $title = '';
    
    #[Validate]
    public $email = '';
    
    protected function rules()
    {
        return [
            'title' => [
                'required',
                'min:5',
                Rule::unique('posts')->ignore($this->post),
            ],
            'email' => 'required|email',
        ];
    }
    
    // Custom messages
    protected function messages()
    {
        return [
            'title.required' => 'De titel is verplicht',
            'title.unique' => 'Deze titel bestaat al',
        ];
    }
    
    // Custom attribute names
    protected function validationAttributes()
    {
        return [
            'title' => 'titel',
            'email' => 'e-mailadres',
        ];
    }
}
```

### Manual Validation

```php
public function save()
{
    // Validate specific fields
    $this->validate([
        'title' => 'required|min:5',
        'content' => 'required',
    ]);
    
    // Or validate specific field manually
    $this->validateOnly('title');
    
    // Or use validate() for all #[Validate] properties
    $this->validate();
}
```

### Custom Validation Rules

```php
use Illuminate\Validation\Validator;

class CreatePost extends Component
{
    #[Validate('required')]
    public $title = '';
    
    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if ($this->titleContainsBadWords()) {
                $validator->errors()->add(
                    'title', 
                    'De titel bevat ongepaste woorden.'
                );
            }
        });
    }
    
    protected function titleContainsBadWords()
    {
        // Custom logic
        return false;
    }
}
```

---

## 📦 Form Objects

### Aanmaken

```bash
php artisan livewire:form PostForm
```

### Form Class

```php
<?php
namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Post;

class PostForm extends Form
{
    public ?Post $post;
    
    #[Validate('required|min:5')]
    public $title = '';
    
    #[Validate('required|min:10')]
    public $content = '';
    
    // For create
    public function store()
    {
        $this->validate();
        
        Post::create($this->only(['title', 'content']));
        
        $this->reset();
    }
    
    // For update
    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }
    
    public function update()
    {
        $this->validate();
        
        $this->post->update($this->only(['title', 'content']));
    }
}
```

### Gebruik in Component

```php
use App\Livewire\Forms\PostForm;

class CreatePost extends Component
{
    public PostForm $form;
    
    public function save()
    {
        $this->form->store();
        return $this->redirect('/posts');
    }
}

class UpdatePost extends Component
{
    public PostForm $form;
    
    public function mount(Post $post)
    {
        $this->form->setPost($post);
    }
    
    public function save()
    {
        $this->form->update();
        return $this->redirect('/posts');
    }
}
```

### Gebruik in View

```blade
<form wire:submit="save">
    <input wire:model="form.title">
    @error('form.title') <span>{{ $message }}</span> @enderror
    
    <textarea wire:model="form.content"></textarea>
    @error('form.content') <span>{{ $message }}</span> @enderror
    
    <button type="submit">Save</button>
</form>
```

### Form Helpers

```php
// Reset
$this->form->reset();
$this->form->reset('title');
$this->form->reset(['title', 'content']);

// Pull (get + reset)
$title = $this->form->pull('title');
$data = $this->form->pull(['title', 'content']);

// Only specific fields
$data = $this->form->only(['title', 'content']);
$data = $this->form->except(['created_at', 'updated_at']);

// All data
$data = $this->form->all();
```

---

## 📤 File Uploads

### Setup

```php
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UploadPhoto extends Component
{
    use WithFileUploads;
    
    #[Validate('image|max:1024')]  // Max 1MB
    public $photo;
    
    public function save()
    {
        $this->validate();
        
        // Store with auto-generated name
        $path = $this->photo->store('photos');
        
        // Store with custom name
        $path = $this->photo->storeAs('photos', 'profile.jpg');
        
        // Store publicly
        $path = $this->photo->storePublicly('photos');
        
        auth()->user()->update(['photo' => $path]);
    }
}
```

### View

```blade
<form wire:submit="save">
    <input type="file" wire:model="photo">
    
    @error('photo') 
        <span class="text-red-500">{{ $message }}</span> 
    @enderror
    
    {{-- Preview --}}
    @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-32">
    @endif
    
    {{-- Upload progress --}}
    <div wire:loading wire:target="photo">
        Uploading...
    </div>
    
    <button type="submit">Save Photo</button>
</form>
```

### Multiple Files

```php
#[Validate('photos.*', rule: 'image|max:1024')]
public $photos = [];

public function save()
{
    $this->validate();
    
    foreach ($this->photos as $photo) {
        $photo->store('photos');
    }
}
```

```blade
<input type="file" wire:model="photos" multiple>

@if ($photos)
    @foreach ($photos as $photo)
        <img src="{{ $photo->temporaryUrl() }}">
    @endforeach
@endif
```

### Upload Progress (JS)

```blade
<form wire:submit="save">
    <input type="file" wire:model="photo" x-on:livewire-upload-start="uploading = true"
           x-on:livewire-upload-finish="uploading = false"
           x-on:livewire-upload-error="uploading = false"
           x-on:livewire-upload-progress="progress = $event.detail.progress">
    
    {{-- Progress bar --}}
    <div x-show="uploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
    
    <button type="submit">Save</button>
</form>
```

### File Validation

```php
#[Validate([
    'photo' => 'required|image|mimes:jpg,png|max:2048',
    'document' => 'required|file|mimes:pdf,doc,docx|max:5120',
    'video' => 'nullable|file|mimetypes:video/mp4|max:51200',
])]
```

---

## 🎨 Advanced Form Patterns

### Real-time Auto-save

```php
class UpdatePost extends Component
{
    public Post $post;
    
    #[Validate('required')]
    public $title = '';
    
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
    }
    
    public function updated($name, $value)
    {
        // Auto-save after each field change
        $this->validate();
        $this->post->update([$name => $value]);
    }
}
```

```blade
<form>
    <input wire:model.blur="title">
    @error('title') <span>{{ $message }}</span> @enderror
    
    <div wire:dirty wire:target="title">
        Unsaved changes...
    </div>
</form>
```

### Conditional Validation

```php
class CreatePost extends Component
{
    public $published = false;
    public $publishDate = null;
    
    public function save()
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        
        if ($this->published) {
            $rules['publishDate'] = 'required|date';
        }
        
        $this->validate($rules);
        
        Post::create([...]);
    }
}
```

### Dependent Fields

```php
class AddressForm extends Component
{
    public $country = '';
    public $state = '';
    public $city = '';
    
    public function updatedCountry()
    {
        // Reset dependent fields
        $this->state = '';
        $this->city = '';
    }
    
    public function render()
    {
        return view('livewire.address-form', [
            'states' => $this->country 
                ? State::where('country', $this->country)->get() 
                : collect(),
        ]);
    }
}
```

### Multi-step Forms

```php
class MultiStepForm extends Component
{
    public $step = 1;
    
    // Step 1
    #[Validate('required')]
    public $name = '';
    
    // Step 2
    #[Validate('required|email')]
    public $email = '';
    
    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validateOnly('name');
        } elseif ($this->step === 2) {
            $this->validateOnly('email');
        }
        
        $this->step++;
    }
    
    public function previousStep()
    {
        $this->step--;
    }
    
    public function submit()
    {
        $this->validate();
        
        // Save all data
        User::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);
    }
}
```

```blade
<div>
    @if ($step === 1)
        <input wire:model="name">
        @error('name') <span>{{ $message }}</span> @enderror
        <button wire:click="nextStep">Next</button>
    @elseif ($step === 2)
        <input wire:model="email">
        @error('email') <span>{{ $message }}</span> @enderror
        <button wire:click="previousStep">Back</button>
        <button wire:click="nextStep">Next</button>
    @else
        <button wire:click="previousStep">Back</button>
        <button wire:click="submit">Submit</button>
    @endif
</div>
```

---

## 🎯 Form Best Practices

### 1. Extract Input Components

```blade
{{-- resources/views/components/input-text.blade.php --}}
@props(['name', 'label'])

<div class="mb-4">
    <label>{{ $label }}</label>
    <input type="text" {{ $attributes }} class="border rounded px-3 py-2">
    @error($name) 
        <span class="text-red-500 text-sm">{{ $message }}</span> 
    @enderror
</div>
```

**Gebruik:**
```blade
<form wire:submit="save">
    <x-input-text name="title" label="Title" wire:model.blur="title" />
    <x-input-text name="email" label="Email" wire:model.blur="email" />
</form>
```

### 2. Disable Submit During Processing

```blade
<button 
    type="submit" 
    wire:loading.attr="disabled"
    wire:target="save"
>
    <span wire:loading.remove wire:target="save">Save</span>
    <span wire:loading wire:target="save">Saving...</span>
</button>
```

### 3. Clear Errors on Input

```php
public function updatedTitle()
{
    $this->resetValidation('title');
}
```

### 4. Show All Errors

```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

---

## 🐛 Troubleshooting

### Validation not working?
- Check `use Livewire\Attributes\Validate;` import
- Call `$this->validate()` in action
- Verify validation rules syntax

### File upload stuck?
- Check `use WithFileUploads;` trait
- Verify `php.ini`: `upload_max_filesize` & `post_max_size`
- Check Livewire temp directory permissions

### Real-time validation too aggressive?
- Use `.blur` instead of `.live`
- Increase debounce: `.live.debounce.500ms`

---

**Zie ook:**
- `/docs/livewire/livewire-core.md` - Component basics
- `/docs/livewire/livewire-advanced.md` - Events & lifecycle
- `/docs/livewire/livewire-patterns.md` - Common UI patterns
