# Livewire 3.x - Core Essentials

> Basis componenten, properties en actions voor dagelijks gebruik
> **Pad**: `/docs/livewire/livewire-core.md`

---

## 📦 Component Basics

### Aanmaken

```bash
# Class component
php artisan make:livewire CreatePost
php artisan make:livewire Posts/CreatePost  # Met namespace

# Inline component
php artisan make:livewire CreatePost --inline

# Kebab-case
php artisan make:livewire create-post
```

### Basis Structuur

```php
<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class CreatePost extends Component
{
    // Properties (public = beschikbaar in view)
    public $title = '';
    public $content = '';
    
    // Mount: initialize (alleen eerste load)
    public function mount($initialTitle = null)
    {
        $this->title = $initialTitle;
    }
    
    // Actions: callable from frontend
    public function save()
    {
        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);
        
        return $this->redirect('/posts');
    }
    
    // Render (optioneel, default view wordt automatisch gebruikt)
    public function render()
    {
        return view('livewire.create-post');
    }
}
```

### Rendering

**In Blade templates:**
```blade
{{-- Tag syntax (preferred) --}}
<livewire:create-post />
<livewire:posts.create-post />  {{-- Nested --}}

{{-- Met data --}}
<livewire:create-post title="Initial Title" />
<livewire:create-post :title="$dynamic" />

{{-- Directive syntax --}}
@livewire('create-post')
@livewire(CreatePost::class, ['title' => 'Init'])
```

**Full-page components:**
```php
// routes/web.php
use App\Livewire\CreatePost;

Route::get('/posts/create', CreatePost::class);
Route::get('/posts/{post}', ShowPost::class);  // Model binding
```

### Layouts

```php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Create Post')]
class CreatePost extends Component
{
    // Of in render:
    public function render()
    {
        return view('livewire.create-post')
            ->layout('layouts.app')
            ->title('Create Post');
    }
}
```

**Global config:**
```php
// config/livewire.php
'layout' => 'layouts.app',
```

---

## 🔧 Properties

### Supported Types

```php
class CreatePost extends Component
{
    // Primitives
    public $title = '';                    // string
    public $count = 0;                     // int
    public $price = 9.99;                  // float
    public $published = false;             // bool
    public $tags = [];                     // array
    
    // Common PHP types
    public $posts;                         // Collection
    public Post $post;                     // Model (auto-locked!)
    public $created_at;                    // DateTime/Carbon
    
    // Typed properties
    public string $title = '';
    public ?int $count = null;
}
```

### Initialiseren

```php
public function mount(Post $post)
{
    // Individual
    $this->title = $post->title;
    
    // Bulk fill
    $this->fill($post->only('title', 'content'));
}

// Reset
$this->reset('title');
$this->reset(['title', 'content']);

// Pull (get + reset)
$title = $this->pull('title');
```

### Data Binding

```blade
{{-- Default: syncs on action --}}
<input type="text" wire:model="title">

{{-- Live: syncs tijdens typen (250ms debounce) --}}
<input type="text" wire:model.live="title">

{{-- Blur: syncs bij tab/click away --}}
<input type="text" wire:model.blur="title">

{{-- Custom debounce --}}
<input wire:model.live.debounce.150ms="title">

{{-- Throttle: fixed interval --}}
<input wire:model.live.throttle.500ms="search">

{{-- Type casting --}}
<input wire:model.number="count">
<input wire:model.boolean="active">
```

### Accessing in View

```blade
{{-- Direct access --}}
<h1>{{ $title }}</h1>

{{-- Loop met wire:key (VERPLICHT!) --}}
@foreach ($posts as $post)
    <div wire:key="post-{{ $post->id }}">
        {{ $post->title }}
    </div>
@endforeach
```

### JavaScript Access ($wire)

```blade
<div>
    {{-- Read --}}
    <span x-text="$wire.title"></span>
    
    {{-- Write --}}
    <button @click="$wire.title = ''">Clear</button>
    <button @click="$wire.set('title', '', false)">Clear (no sync)</button>
    
    {{-- Properties in Alpine --}}
    <div x-data="{ localTitle: $wire.title }">
        <span x-text="localTitle"></span>
    </div>
</div>
```

---

## ⚡ Actions

### Basic Actions

```php
class CreatePost extends Component
{
    public $title = '';
    
    // Public = callable from frontend
    public function save()
    {
        Post::create(['title' => $this->title]);
        
        session()->flash('status', 'Post created!');
        return $this->redirect('/posts');
    }
    
    // Protected/Private = NOT callable
    protected function helperMethod()
    {
        // Safe from client-side calls
    }
}
```

```blade
{{-- Form submit --}}
<form wire:submit="save">
    <input wire:model="title">
    <button type="submit">Save</button>
</form>

{{-- Button click --}}
<button wire:click="save">Save</button>

{{-- Met parameters --}}
<button wire:click="delete({{ $post->id }})">Delete</button>
```

### Parameters

```php
// Basic parameter
public function delete($id)
{
    $post = Post::findOrFail($id);
    $this->authorize('delete', $post);  // ALWAYS authorize!
    $post->delete();
}

// Model binding
public function delete(Post $post)
{
    $this->authorize('delete', $post);
    $post->delete();
}

// Multiple parameters
public function update($id, $field, $value)
{
    // ...
}
```

```blade
<button wire:click="delete({{ $post->id }})">Delete</button>
<button wire:click="update({{ $post->id }}, 'title', 'New')">Update</button>
```

### Magic Actions

```blade
{{-- Refresh component --}}
<button wire:click="$refresh">Refresh</button>

{{-- Set property --}}
<button wire:click="$set('query', '')">Reset Search</button>

{{-- Toggle boolean --}}
<button wire:click="$toggle('sortAsc')">Toggle Sort</button>

{{-- Parent access (from child) --}}
<button wire:click="$parent.removePost({{ $post->id }})">Remove</button>

{{-- Dispatch event --}}
<button wire:click="$dispatch('post-created')">Create</button>
```

---

## 🎯 Event Listeners

### Click Events

```blade
{{-- Basic --}}
<button wire:click="save">Save</button>

{{-- Met parameters --}}
<button wire:click="save('draft')">Save Draft</button>

{{-- Prevent default --}}
<a href="#" wire:click.prevent="save">Save</a>

{{-- Stop propagation --}}
<div wire:click="outer">
    <button wire:click.stop="inner">Inner</button>
</div>
```

### Keyboard Events

```blade
{{-- Enter key --}}
<input wire:keydown.enter="search">

{{-- Multiple modifiers --}}
<input wire:keydown.shift.enter="submit">
<input wire:keydown.ctrl.s.prevent="save">

{{-- Key aliases --}}
wire:keydown.escape="close"
wire:keydown.tab="next"
wire:keydown.space="toggle"
wire:keydown.up="previous"
wire:keydown.down="next"
```

### Form Events

```blade
<form wire:submit="save">
    <input wire:model="title">
    <button type="submit">Save</button>
</form>

{{-- Prevent default (automatic on wire:submit) --}}
<form wire:submit.prevent="save">...</form>
```

### Event Modifiers

```blade
wire:click.prevent        {{-- preventDefault() --}}
wire:click.stop           {{-- stopPropagation() --}}
wire:click.self           {{-- Only on this element --}}
wire:click.once           {{-- Fire once --}}
wire:click.debounce.500ms {{-- Debounce --}}
wire:click.throttle.500ms {{-- Throttle --}}
wire:click.window         {{-- Listen on window --}}
wire:click.outside        {{-- Clicks outside element --}}
```

---

## 🎨 Essential Directives

### wire:loading

```blade
{{-- Show during any action --}}
<div wire:loading>Loading...</div>

{{-- Target specific action --}}
<button wire:click="save">
    Save
    <span wire:loading wire:target="save">Saving...</span>
</button>

{{-- CSS classes --}}
<div wire:loading.class="opacity-50">
    Content fades during action
</div>

<button wire:loading.attr="disabled">
    Can't click while loading
</button>

{{-- Delay showing (good for fast requests) --}}
<div wire:loading.delay>Loading...</div>
<div wire:loading.delay.shortest>Loading...</div>  {{-- 50ms --}}
<div wire:loading.delay.shorter>Loading...</div>   {{-- 100ms --}}
<div wire:loading.delay.short>Loading...</div>     {{-- 150ms --}}
<div wire:loading.delay.long>Loading...</div>      {{-- 200ms --}}
<div wire:loading.delay.longer>Loading...</div>    {{-- 300ms --}}
<div wire:loading.delay.longest>Loading...</div>   {{-- 400ms --}}
```

### wire:dirty

```blade
{{-- Show when field has unsaved changes --}}
<input wire:model="title" wire:dirty.class="border-yellow-500">

<div wire:dirty wire:target="title">
    Unsaved changes...
</div>
```

### wire:confirm

```blade
<button 
    wire:click="delete" 
    wire:confirm="Are you sure you want to delete this post?"
>
    Delete
</button>

{{-- Custom prompt --}}
<button 
    wire:click="delete"
    wire:confirm.prompt="Type DELETE to confirm|DELETE"
>
    Delete Account
</button>
```

### wire:key (VERPLICHT in loops!)

```blade
@foreach ($posts as $post)
    <div wire:key="post-{{ $post->id }}">
        {{ $post->title }}
    </div>
@endforeach

{{-- Ook bij nested components in loop --}}
@foreach ($posts as $post)
    <livewire:post-item :$post :key="$post->id" />
@endforeach
```

---

## 🔄 Lifecycle Hooks

```php
class CreatePost extends Component
{
    // Runs on every request
    public function boot()
    {
        // Initialize things needed for every request
    }
    
    // Runs only on initial load
    public function mount($title = null)
    {
        $this->title = $title;
    }
    
    // Before property update
    public function updating($name, $value)
    {
        // Runs before ANY property updates
    }
    
    public function updatingTitle($value)
    {
        // Runs before $title updates
        // Great for sanitization
    }
    
    // After property update
    public function updated($name, $value)
    {
        // Runs after ANY property updates
        // Perfect for auto-save
    }
    
    public function updatedTitle($value)
    {
        // Runs after $title updates
    }
    
    // Render
    public function render()
    {
        return view('livewire.create-post');
    }
}
```

---

## 🔒 Security Essentials

### 1. Lock Properties

```php
use Livewire\Attributes\Locked;

class UpdatePost extends Component
{
    #[Locked]  // Cannot be changed from frontend
    public $postId;
    
    public Post $post;  // Eloquent models auto-locked
}
```

### 2. Always Validate

```php
use Livewire\Attributes\Validate;

#[Validate('required|min:5')]
public $title = '';

public function save()
{
    $this->validate();  // Always validate!
    // ...
}
```

### 3. Always Authorize

```php
public function delete($id)
{
    $post = Post::findOrFail($id);
    
    // CRITICAL: Always authorize
    $this->authorize('delete', $post);
    
    $post->delete();
}
```

### 4. Protected Methods

```php
// Public = callable from browser
public function delete($id) { }

// Protected = NOT callable from browser
protected function deletePost($id) { }
```

---

## 🚀 Quick Patterns

### Simple CRUD

```php
class ManagePosts extends Component
{
    public $posts;
    public $title = '';
    
    public function mount()
    {
        $this->loadPosts();
    }
    
    public function create()
    {
        Post::create(['title' => $this->title]);
        $this->reset('title');
        $this->loadPosts();
    }
    
    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        $this->loadPosts();
    }
    
    protected function loadPosts()
    {
        $this->posts = Post::all();
    }
}
```

### Modal Toggle

```php
class ShowPosts extends Component
{
    public $showModal = false;
    public $selectedPost = null;
    
    public function openModal($postId)
    {
        $this->selectedPost = Post::find($postId);
        $this->showModal = true;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedPost = null;
    }
}
```

---

## 📚 Tips

1. **wire:key** - ALTIJD gebruiken in loops
2. **Authorization** - ALTIJD checken in actions
3. **Validation** - ALTIJD valideren voor save
4. **Protected methods** - Voor interne logica
5. **Loading states** - Geef altijd feedback
6. **Locked properties** - Voor IDs en gevoelige data
7. **Type hints** - Gebruik voor model binding
8. **Computed properties** - Voor dure queries (zie livewire-advanced.md)

---

**Zie ook:**
- `/docs/livewire/livewire-forms.md` - Forms & validation
- `/docs/livewire/livewire-advanced.md` - Events, Alpine, JS
- `/docs/livewire/livewire-directives.md` - Alle wire:* directives
- `/docs/livewire/livewire-patterns.md` - Common patterns & troubleshooting
