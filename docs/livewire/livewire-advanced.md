# Livewire 3.x - Advanced Features

> Events, Alpine integration, JavaScript API en computed properties
> **Pad**: `/docs/livewire/livewire-advanced.md`

---

## 🔔 Events System

### Dispatching Events

```php
class CreatePost extends Component
{
    public function save()
    {
        $post = Post::create([...]);
        
        // Basic dispatch
        $this->dispatch('post-created');
        
        // With data
        $this->dispatch('post-created', title: $post->title, id: $post->id);
        
        // To specific component
        $this->dispatch('post-created')->to(Dashboard::class);
        
        // To self only
        $this->dispatch('post-created')->self();
    }
}
```

**From Blade:**
```blade
<button wire:click="$dispatch('show-modal', { id: {{ $post->id }} })">
    Edit Post
</button>

<button wire:click="$dispatchTo('posts', 'refresh')">
    Refresh Posts
</button>
```

### Listening for Events

```php
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $postCount = 0;
    
    #[On('post-created')]
    public function incrementPostCount($title = null)
    {
        $this->postCount++;
        
        // Access dispatched data
        if ($title) {
            session()->flash('message', "Post '$title' created!");
        }
    }
    
    // Dynamic event names
    #[On('post-updated.{post.id}')]
    public function refreshPost()
    {
        // Listens to: post-updated.1, post-updated.2, etc.
    }
    
    // Multiple events
    #[On(['post-created', 'post-updated'])]
    public function refresh()
    {
        // Handles both events
    }
}
```

**Listen on child components:**
```blade
{{-- In parent view --}}
<livewire:edit-post @saved="$refresh" />
<livewire:edit-post @saved="handleSave" />
<livewire:edit-post @saved="handleSave($event.detail.postId)" />
```

### JavaScript Integration

```blade
@script
<script>
// Listen for events
$wire.on('post-created', (event) => {
    console.log('Post created:', event.detail.title)
    alert('New post: ' + event.detail.title)
})

// Dispatch events
$wire.dispatch('post-created', { title: 'My Post' })
$wire.dispatchSelf('post-created')  // To self only
</script>
@endscript
```

**Global listeners:**
```blade
<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('post-created', (event) => {
        console.log('Global listener:', event.detail)
    })
})
</script>
```

---

## 🏔️ Alpine Integration

### $wire Object

```blade
<div x-data="{ open: false }">
    {{-- Read properties --}}
    <span x-text="$wire.title"></span>
    <span x-text="$wire.get('title')"></span>
    
    {{-- Write properties --}}
    <button @click="$wire.title = 'New Title'">Set Title</button>
    <button @click="$wire.set('title', 'New')">Set Title</button>
    
    {{-- Call actions --}}
    <button @click="$wire.save()">Save</button>
    <button @click="await $wire.save()">Async Save</button>
    
    {{-- Call with parameters --}}
    <button @click="$wire.delete({{ $post->id }})">Delete</button>
    
    {{-- Magic actions --}}
    <button @click="$wire.$refresh()">Refresh</button>
    <button @click="$wire.$toggle('show')">Toggle</button>
</div>
```

### Entangle (Two-way Binding)

```blade
<div x-data="{ 
    open: $wire.entangle('showModal') 
}">
    {{-- Changes sync between Alpine and Livewire --}}
    <button @click="open = !open">Toggle Modal</button>
    
    <div x-show="open">
        Modal content
        <button wire:click="$set('showModal', false)">Close</button>
    </div>
</div>
```

**Deferred entangle:**
```blade
<div x-data="{ 
    search: $wire.entangle('search').defer 
}">
    {{-- Only syncs on next Livewire update --}}
    <input x-model="search">
</div>
```

### Alpine Events

```blade
{{-- Listen for Livewire events in Alpine --}}
<div @post-created.window="console.log($event.detail)">
    Listens globally
</div>

<div @post-created="console.log($event.detail)">
    Listens locally (must be child of dispatcher)
</div>

{{-- Dispatch to Livewire from Alpine --}}
<button @click="$dispatch('post-created', { title: 'My Post' })">
    Create
</button>
```

### Accessing Component Element

```blade
@script
<script>
// Component root element
let element = $wire.$el

// Find elements inside component
let input = $wire.$el.querySelector('input[type="text"]')

// Example: Initialize third-party library
new Pikaday({ 
    field: $wire.$el.querySelector('[data-picker]') 
})
</script>
@endscript
```

---

## 📜 JavaScript API

### @script Directive

```blade
@script
<script>
// Has access to $wire for this component
console.log('Component ID:', $wire.$id)

// Auto-refresh every 5 seconds
setInterval(() => {
    $wire.$refresh()
}, 5000)

// Call action when condition met
if ($wire.count > 10) {
    $wire.notifyAdmin()
}
</script>
@endscript
```

### @assets Directive

```blade
{{-- Loads once per page, not per component instance --}}
@assets
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<link href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css" rel="stylesheet">
@endassets

@script
<script>
// Use the loaded library
new Pikaday({ 
    field: $wire.$el.querySelector('[data-picker]') 
})
</script>
@endscript
```

### JavaScript Actions

```php
class ShowPost extends Component
{
    public Post $post;
    public $bookmarked = false;
    
    public function bookmarkPost()
    {
        $this->post->bookmark(auth()->user());
        $this->bookmarked = true;
    }
}
```

```blade
<button wire:click="$js.bookmark">
    <svg wire:show="bookmarked">❤️</svg>
    <svg wire:show="!bookmarked">🤍</svg>
</button>

@script
<script>
$js('bookmark', () => {
    // Optimistic UI update
    $wire.bookmarked = !$wire.bookmarked
    
    // Then persist
    $wire.bookmarkPost()
})
</script>
@endscript
```

**Call from PHP:**
```php
public function save()
{
    // Save logic...
    
    // Trigger JS action
    $this->js('onPostSaved');
}
```

### Wire Object Reference

```javascript
// Properties
$wire.propertyName
$wire.get('propertyName')
$wire.set('propertyName', value, defer = false)

// Actions
$wire.actionName()
$wire.actionName(param1, param2)
await $wire.actionName()  // Wait for completion

// Magic actions
$wire.$refresh()
$wire.$commit()
$wire.$toggle('property')
$wire.$set('property', value)

// Events
$wire.dispatch('event-name', { data: 'value' })
$wire.dispatchSelf('event-name')
$wire.on('event-name', (event) => { })

// Component info
$wire.$id        // Component ID
$wire.$el        // Root DOM element
$wire.$wire      // Reference to self (for nested access)
```

---

## ⚙️ Computed Properties

```php
use Livewire\Attributes\Computed;

class ShowPosts extends Component
{
    public $search = '';
    
    #[Computed]
    public function posts()
    {
        // Cached for the duration of request
        return Post::where('title', 'like', "%{$this->search}%")
            ->with('author')
            ->get();
    }
    
    #[Computed]
    public function featuredPosts()
    {
        // Can reference other computed properties
        return $this->posts->where('featured', true);
    }
    
    public function render()
    {
        return view('livewire.show-posts');
    }
}
```

**Access in view:**
```blade
{{-- Via $this --}}
@foreach ($this->posts as $post)
    <div wire:key="post-{{ $post->id }}">
        {{ $post->title }}
    </div>
@endforeach

{{-- Featured posts --}}
<div>
    <h2>Featured</h2>
    @foreach ($this->featuredPosts as $post)
        {{ $post->title }}
    @endforeach
</div>
```

**Access in component:**
```php
public function markAllAsRead()
{
    $this->posts->each->markAsRead();
}
```

**Cache control:**
```php
#[Computed(persist: true)]  // Persist across requests
#[Computed(cache: false)]   // Disable caching
```

---

## 📊 Pagination

```php
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    
    public $search = '';
    
    public function updatingSearch()
    {
        $this->resetPage();  // Reset to page 1 on search
    }
    
    public function render()
    {
        return view('livewire.show-posts', [
            'posts' => Post::where('title', 'like', "%{$this->search}%")
                ->paginate(10),
        ]);
    }
}
```

```blade
<div>
    <input wire:model.live="search" placeholder="Search...">
    
    @foreach ($posts as $post)
        <div wire:key="post-{{ $post->id }}">
            {{ $post->title }}
        </div>
    @endforeach
    
    {{ $posts->links() }}  {{-- Pagination links --}}
</div>
```

**Custom pagination view:**
```php
public function render()
{
    return view('livewire.show-posts', [
        'posts' => Post::paginate(10),
    ]);
}
```

```blade
{{ $posts->links('pagination::tailwind') }}
{{ $posts->links('pagination::bootstrap-4') }}
```

**Simple pagination:**
```php
'posts' => Post::simplePaginate(10),  // Only next/prev
```

---

## 🔗 URL Query Parameters

```php
use Livewire\Attributes\Url;

class SearchPosts extends Component
{
    #[Url]
    public $search = '';
    
    #[Url(as: 'q')]  // Custom URL param name
    public $query = '';
    
    #[Url(keep: true)]  // Keep in URL even when empty
    public $filter = '';
    
    #[Url(history: true)]  // Push to browser history
    public $page = 1;
    
    #[Url(except: '')]  // Don't add to URL if empty string
    public $sort = '';
}
```

**Result URLs:**
```
/posts?search=laravel&q=livewire&filter=&page=2
```

---

## 💾 Session Properties

```php
use Livewire\Attributes\Session;

class ShoppingCart extends Component
{
    #[Session]
    public $items = [];
    
    #[Session(key: 'user_preferences')]
    public $preferences = [];
    
    public function addToCart($productId)
    {
        $this->items[] = $productId;
        // Automatically saved to session
    }
}
```

---

## 🚀 Lazy Loading

```php
use Livewire\Attributes\Lazy;

#[Lazy]
class ExpensiveComponent extends Component
{
    public function placeholder()
    {
        // Shown while loading
        return view('livewire.placeholder');
    }
    
    public function render()
    {
        sleep(2);  // Simulate slow query
        
        $data = $this->getExpensiveData();
        
        return view('livewire.expensive-component', [
            'data' => $data,
        ]);
    }
}
```

```blade
{{-- Component loads after page render --}}
<livewire:expensive-component lazy />
```

**Placeholder view:**
```blade
{{-- resources/views/livewire/placeholder.blade.php --}}
<div>
    <div class="animate-pulse">Loading...</div>
</div>
```

---

## 🎯 Laravel Echo (WebSockets)

```php
use Livewire\Attributes\On;

class OrderTracker extends Component
{
    public Order $order;
    public $status = 'pending';
    
    // Listen to public channel
    #[On('echo:orders,OrderShipped')]
    public function notifyShipped($event)
    {
        $this->status = 'shipped';
    }
    
    // Listen to private channel (dynamic)
    public function getListeners()
    {
        return [
            "echo-private:orders.{$this->order->id},OrderShipped" => 'notifyShipped',
            "echo-presence:team.{$this->order->team_id},here" => 'updatePresence',
            "echo-presence:team.{$this->order->team_id},joining" => 'memberJoined',
            "echo-presence:team.{$this->order->team_id},leaving" => 'memberLeft',
        ];
    }
    
    public function notifyShipped($event)
    {
        $this->status = $event['status'];
    }
}
```

**Event class:**
```php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderShipped implements ShouldBroadcast
{
    public function __construct(public Order $order) {}
    
    public function broadcastOn()
    {
        return new Channel('orders');
        // Or private: new PrivateChannel('orders.' . $this->order->id);
    }
}
```

---

## 🔄 Lifecycle Hooks (Complete)

```php
class MyComponent extends Component
{
    // 1. BOOT: Before everything (every request)
    public function boot()
    {
        // Great for setting global state
    }
    
    // 2. MOUNT: Initialize (first load only)
    public function mount($post)
    {
        $this->post = $post;
    }
    
    // 3. HYDRATE: After receiving from browser
    public function hydrate()
    {
        // Reconstruct component state
    }
    
    // 4. HYDRATE PROPERTY: Specific property hydration
    public function hydrateTitle($value)
    {
        // Process specific property
    }
    
    // 5. UPDATING: Before property update
    public function updating($name, $value)
    {
        // Intercept any property change
    }
    
    public function updatingTitle($value)
    {
        // Sanitize before setting
        return strtolower($value);
    }
    
    // 6. UPDATED: After property update
    public function updated($name, $value)
    {
        // React to any property change
        // Great for auto-save
    }
    
    public function updatedTitle($value)
    {
        // Clear errors after edit
        $this->resetValidation('title');
    }
    
    // 7. DEHYDRATE PROPERTY: Before sending to browser
    public function dehydrateTitle($value)
    {
        // Process before sending
    }
    
    // 8. DEHYDRATE: Before sending to browser
    public function dehydrate()
    {
        // Cleanup before sending
    }
    
    // 9. RENDER: Render view
    public function render()
    {
        return view('livewire.my-component');
    }
}
```

---

## 🐛 Troubleshooting Advanced

### Events not firing?
- Check event name spelling
- Verify listener component is on page
- Use browser DevTools to see dispatched events

### Alpine not working?
- Check Alpine is loaded (included by Livewire)
- Verify `x-data` is present
- Check browser console for errors

### Computed property not updating?
- Access via `$this->property` not `$this->property()`
- Cache is per-request only
- Use `#[Computed(cache: false)]` to disable

### Echo not connecting?
- Verify Laravel Echo is installed
- Check `config/broadcasting.php`
- Ensure channel authorization is set up

---

**Zie ook:**
- `/docs/livewire/livewire-core.md` - Component basics
- `/docs/livewire/livewire-forms.md` - Forms & validation
- `/docs/livewire/livewire-directives.md` - All directives reference
- `/docs/livewire/livewire-patterns.md` - UI patterns
