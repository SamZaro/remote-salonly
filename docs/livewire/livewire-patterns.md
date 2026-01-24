# Livewire 3.x - Patterns & Best Practices

> Common UI patterns, security, testing en troubleshooting
> **Pad**: `/docs/livewire/livewire-patterns.md`

---

## 🎨 Common UI Patterns

### Modal Pattern

```php
class ManagePosts extends Component
{
    public $showModal = false;
    public $editingPost = null;
    
    public function create()
    {
        $this->editingPost = new Post();
        $this->showModal = true;
    }
    
    public function edit(Post $post)
    {
        $this->editingPost = $post;
        $this->showModal = true;
    }
    
    public function save()
    {
        $this->validate([
            'editingPost.title' => 'required',
        ]);
        
        $this->editingPost->save();
        $this->closeModal();
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->editingPost = null;
        $this->resetValidation();
    }
}
```

```blade
<div>
    <button wire:click="create">Create Post</button>
    
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75">
            <div class="bg-white p-6">
                <h2>{{ $editingPost->exists ? 'Edit' : 'Create' }} Post</h2>
                
                <input wire:model="editingPost.title">
                @error('editingPost.title') <span>{{ $message }}</span> @enderror
                
                <button wire:click="save">Save</button>
                <button wire:click="closeModal">Cancel</button>
            </div>
        </div>
    @endif
</div>
```

### Search & Filter Pattern

```php
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class SearchPosts extends Component
{
    use WithPagination;
    
    #[Url]
    public $search = '';
    
    #[Url]
    public $category = '';
    
    #[Url]
    public $sortBy = 'created_at';
    
    #[Url]
    public $sortDirection = 'desc';
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategory()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function render()
    {
        return view('livewire.search-posts', [
            'posts' => Post::query()
                ->when($this->search, fn($q) => 
                    $q->where('title', 'like', "%{$this->search}%")
                )
                ->when($this->category, fn($q) => 
                    $q->where('category', $this->category)
                )
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(10),
        ]);
    }
}
```

```blade
<div>
    <input wire:model.live.debounce.300ms="search" placeholder="Search...">
    
    <select wire:model.live="category">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat }}">{{ $cat }}</option>
        @endforeach
    </select>
    
    <table>
        <thead>
            <tr>
                <th wire:click="sortBy('title')">
                    Title 
                    @if($sortBy === 'title')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr wire:key="post-{{ $post->id }}">
                    <td>{{ $post->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $posts->links() }}
</div>
```

### Master-Detail Pattern

```php
class ShowPosts extends Component
{
    public $posts;
    public ?Post $selectedPost = null;
    
    public function mount()
    {
        $this->posts = Post::all();
    }
    
    public function selectPost($id)
    {
        $this->selectedPost = Post::find($id);
    }
    
    public function clearSelection()
    {
        $this->selectedPost = null;
    }
}
```

```blade
<div class="flex">
    {{-- Master: List --}}
    <div class="w-1/3">
        @foreach($posts as $post)
            <div 
                wire:key="post-{{ $post->id }}"
                wire:click="selectPost({{ $post->id }})"
                class="{{ $selectedPost?->id === $post->id ? 'bg-blue-100' : '' }}"
            >
                {{ $post->title }}
            </div>
        @endforeach
    </div>
    
    {{-- Detail --}}
    <div class="w-2/3">
        @if($selectedPost)
            <h2>{{ $selectedPost->title }}</h2>
            <p>{{ $selectedPost->content }}</p>
            <button wire:click="clearSelection">Close</button>
        @else
            <p>Select a post to view details</p>
        @endif
    </div>
</div>
```

### Inline Editing Pattern

```php
class PostList extends Component
{
    public $posts;
    public $editingId = null;
    public $editingTitle = '';
    
    public function mount()
    {
        $this->posts = Post::all();
    }
    
    public function edit($id)
    {
        $this->editingId = $id;
        $this->editingTitle = Post::find($id)->title;
    }
    
    public function save()
    {
        $post = Post::find($this->editingId);
        $post->update(['title' => $this->editingTitle]);
        
        $this->editingId = null;
        $this->posts = Post::all();
    }
    
    public function cancel()
    {
        $this->editingId = null;
    }
}
```

```blade
@foreach($posts as $post)
    <div wire:key="post-{{ $post->id }}">
        @if($editingId === $post->id)
            <input wire:model="editingTitle" wire:keydown.enter="save">
            <button wire:click="save">Save</button>
            <button wire:click="cancel">Cancel</button>
        @else
            <span wire:click="edit({{ $post->id }})">{{ $post->title }}</span>
        @endif
    </div>
@endforeach
```

### Tabs Pattern

```php
class Dashboard extends Component
{
    public $activeTab = 'overview';
    
    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }
}
```

```blade
<div>
    <div class="tabs">
        <button 
            wire:click="setTab('overview')"
            class="{{ $activeTab === 'overview' ? 'active' : '' }}"
        >
            Overview
        </button>
        <button 
            wire:click="setTab('settings')"
            class="{{ $activeTab === 'settings' ? 'active' : '' }}"
        >
            Settings
        </button>
    </div>
    
    <div class="tab-content">
        @if($activeTab === 'overview')
            <div>Overview content...</div>
        @elseif($activeTab === 'settings')
            <div>Settings content...</div>
        @endif
    </div>
</div>
```

### Infinite Scroll Pattern

```php
use Livewire\Attributes\On;

class InfiniteScroll extends Component
{
    public $page = 1;
    public $perPage = 10;
    
    public function loadMore()
    {
        $this->page++;
    }
    
    public function render()
    {
        return view('livewire.infinite-scroll', [
            'posts' => Post::paginate($this->perPage * $this->page),
        ]);
    }
}
```

```blade
<div>
    @foreach($posts as $post)
        <div wire:key="post-{{ $post->id }}">
            {{ $post->title }}
        </div>
    @endforeach
    
    <div 
        x-intersect="$wire.loadMore()"
        class="h-20 flex items-center justify-center"
    >
        <span wire:loading wire:target="loadMore">Loading more...</span>
    </div>
</div>
```

### Bulk Actions Pattern

```php
class ManagePosts extends Component
{
    public $posts;
    public $selectedIds = [];
    
    public function mount()
    {
        $this->posts = Post::all();
    }
    
    public function selectAll()
    {
        $this->selectedIds = $this->posts->pluck('id')->toArray();
    }
    
    public function deselectAll()
    {
        $this->selectedIds = [];
    }
    
    public function bulkDelete()
    {
        Post::whereIn('id', $this->selectedIds)->delete();
        $this->selectedIds = [];
        $this->posts = Post::all();
    }
}
```

```blade
<div>
    <button wire:click="selectAll">Select All</button>
    <button wire:click="deselectAll">Deselect All</button>
    
    @if(count($selectedIds) > 0)
        <button wire:click="bulkDelete" wire:confirm="Delete {{ count($selectedIds) }} posts?">
            Delete Selected ({{ count($selectedIds) }})
        </button>
    @endif
    
    @foreach($posts as $post)
        <div wire:key="post-{{ $post->id }}">
            <input 
                type="checkbox" 
                wire:model.live="selectedIds" 
                value="{{ $post->id }}"
            >
            {{ $post->title }}
        </div>
    @endforeach
</div>
```

---

## 🔒 Security Best Practices

### 1. ALTIJD Valideren

```php
use Livewire\Attributes\Validate;

class CreatePost extends Component
{
    #[Validate('required|min:5')]
    public $title = '';
    
    public function save()
    {
        $this->validate();  // VERPLICHT!
        
        Post::create(['title' => $this->title]);
    }
}
```

### 2. ALTIJD Autoriseren

```php
public function delete($id)
{
    $post = Post::findOrFail($id);
    
    // CRITICAL: Authorize
    $this->authorize('delete', $post);
    
    $post->delete();
}

public function update(Post $post)
{
    // Check ownership
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }
    
    $post->update([...]);
}
```

### 3. Lock Gevoelige Properties

```php
use Livewire\Attributes\Locked;

class UpdatePost extends Component
{
    #[Locked]
    public $postId;  // Cannot be changed from browser
    
    public Post $post;  // Models are auto-locked
    
    public $title;  // User can change this
}
```

### 4. Protected/Private Methods

```php
class ManagePosts extends Component
{
    // PUBLIC = callable from browser
    public function delete($id)
    {
        $this->authorize('delete', Post::find($id));
        $this->performDelete($id);
    }
    
    // PROTECTED = NOT callable from browser
    protected function performDelete($id)
    {
        Post::find($id)->delete();
    }
    
    // PRIVATE = NOT callable from browser
    private function logDeletion($id)
    {
        Log::info("Post {$id} deleted");
    }
}
```

### 5. MorphMap (Hide Class Names)

```php
// app/Providers/AppServiceProvider.php
use Illuminate\Database\Eloquent\Relations\Relation;

public function boot()
{
    Relation::morphMap([
        'post' => 'App\Models\Post',
        'user' => 'App\Models\User',
    ]);
}
```

Nu wordt `App\Models\Post` in browser getoond als `post`.

### 6. Rate Limiting

```php
use Illuminate\Support\Facades\RateLimiter;

public function send()
{
    $executed = RateLimiter::attempt(
        'send-message:' . auth()->id(),
        $perMinute = 5,
        function() {
            // Send message
        }
    );
    
    if (!$executed) {
        session()->flash('error', 'Too many messages sent!');
    }
}
```

### 7. CSRF Protection (Auto-handled)

Livewire handelt CSRF automatisch, maar zorg dat:
- `@csrf` token aanwezig is in layout
- Livewire scripts correct geladen zijn

---

## 🧪 Testing

### Basic Component Test

```php
use Livewire\Livewire;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    public function test_can_create_post()
    {
        Livewire::test(CreatePost::class)
            ->set('title', 'Test Post')
            ->set('content', 'Test content')
            ->call('save')
            ->assertRedirect('/posts');
        
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
        ]);
    }
}
```

### Testing Validation

```php
public function test_title_is_required()
{
    Livewire::test(CreatePost::class)
        ->set('title', '')
        ->call('save')
        ->assertHasErrors(['title' => 'required']);
}

public function test_title_must_be_at_least_5_characters()
{
    Livewire::test(CreatePost::class)
        ->set('title', 'Test')
        ->call('save')
        ->assertHasErrors(['title' => 'min']);
}
```

### Testing Authorization

```php
public function test_cannot_delete_other_users_post()
{
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $otherUser->id]);
    
    $this->actingAs($user);
    
    Livewire::test(ManagePosts::class)
        ->call('delete', $post->id)
        ->assertForbidden();
}
```

### Testing Events

```php
public function test_dispatches_post_created_event()
{
    Livewire::test(CreatePost::class)
        ->set('title', 'Test')
        ->call('save')
        ->assertDispatched('post-created');
}

public function test_listens_for_post_created_event()
{
    Livewire::test(Dashboard::class)
        ->assertSee('Posts: 0')
        ->dispatch('post-created')
        ->assertSee('Posts: 1');
}
```

### Testing File Uploads

```php
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

public function test_can_upload_photo()
{
    Storage::fake('public');
    
    $file = UploadedFile::fake()->image('photo.jpg');
    
    Livewire::test(UploadPhoto::class)
        ->set('photo', $file)
        ->call('save');
    
    Storage::disk('public')->assertExists('photos/' . $file->hashName());
}
```

---

## 🐛 Troubleshooting

### Property Not Updating

**Probleem:** Property in component update niet na `wire:model` change.

**Oplossingen:**
```blade
{{-- Check spelling --}}
<input wire:model="title">  {{-- Not "titel" --}}

{{-- Use .live for real-time --}}
<input wire:model.live="search">

{{-- Check for JavaScript errors in console --}}
```

### Action Not Firing

**Probleem:** `wire:click` doet niks.

**Oplossingen:**
```php
// Verify method is public
public function save() { }  // ✓ Works
protected function save() { }  // ✗ Doesn't work

// Check method name
<button wire:click="save">  // Not "Save" or "SAVE"
```

### Validation Not Working

**Probleem:** Errors tonen niet.

**Oplossingen:**
```php
// Import Validate attribute
use Livewire\Attributes\Validate;

// Call validate()
public function save()
{
    $this->validate();  // Don't forget!
    // ...
}
```

```blade
{{-- Check @error name matches property --}}
@error('title') <span>{{ $message }}</span> @enderror
@error('form.title') <span>{{ $message }}</span> @enderror
```

### File Upload Stuck

**Probleem:** File upload loopt vast.

**Oplossingen:**
```php
// Check trait
use Livewire\WithFileUploads;

class UploadPhoto extends Component
{
    use WithFileUploads;  // Don't forget!
}
```

```ini
# Check php.ini limits
upload_max_filesize = 20M
post_max_size = 25M
max_execution_time = 300
```

```bash
# Check Livewire temp directory permissions
chmod -R 775 storage/app/livewire-tmp
```

### Memory Leaks in Loops

**Probleem:** High memory usage met grote datasets.

**Oplossing:**
```php
// Use cursor() for large datasets
public function render()
{
    return view('livewire.posts', [
        'posts' => Post::cursor(),  // Instead of ->get()
    ]);
}

// Or use chunk()
public function processAll()
{
    Post::chunk(100, function($posts) {
        foreach($posts as $post) {
            $this->process($post);
        }
    });
}
```

### wire:key Missing

**Probleem:** Items in loop dupliceren of swappen.

**Oplossing:**
```blade
{{-- ALWAYS add wire:key in loops --}}
@foreach ($posts as $post)
    <div wire:key="post-{{ $post->id }}">
        {{ $post->title }}
    </div>
@endforeach
```

### Alpine Not Working

**Probleem:** `x-data`, `x-show`, etc. werken niet.

**Oplossingen:**
```blade
{{-- Alpine is included by Livewire by default --}}
{{-- Check for JavaScript errors in console --}}

{{-- Verify Livewire scripts are loaded --}}
@livewireScripts
```

### Computed Property Not Caching

**Probleem:** Query runs multiple times per request.

**Oplossing:**
```php
use Livewire\Attributes\Computed;

#[Computed]  // Don't forget attribute!
public function posts()
{
    return Post::all();
}

// Access as property, not method
$this->posts  // ✓ Cached
$this->posts()  // ✗ Not cached
```

---

## 💡 Performance Tips

### 1. Use Computed Properties voor Dure Queries

```php
#[Computed]
public function posts()
{
    return Post::with('author')->get();  // Cached per request
}
```

### 2. Lazy Load Heavy Components

```php
#[Lazy]
class HeavyComponent extends Component
{
    public function placeholder()
    {
        return view('livewire.placeholder');
    }
}
```

### 3. Debounce Search Inputs

```blade
<input wire:model.live.debounce.500ms="search">
```

### 4. Use wire:key in Loops

```blade
@foreach ($items as $item)
    <div wire:key="item-{{ $item->id }}">...</div>
@endforeach
```

### 5. Disable Re-renders When Possible

```php
#[Renderless]
public function logView()
{
    $this->post->logView();
}
```

---

**Zie ook:**
- `/docs/livewire/livewire-core.md` - Component basics
- `/docs/livewire/livewire-forms.md` - Forms & validation
- `/docs/livewire/livewire-advanced.md` - Events & Alpine
- `/docs/livewire/livewire-directives.md` - All directives
