# Livewire 3.x - Directives Reference

> Complete overzicht van alle wire:* directives en modifiers
> **Pad**: `/docs/livewire/livewire-directives.md`

---

## 🎯 wire:model

### Basic Usage

```blade
{{-- Default: syncs on action (submit, etc) --}}
<input type="text" wire:model="title">

{{-- Live: syncs tijdens typen (250ms debounce) --}}
<input type="text" wire:model.live="search">

{{-- Blur: syncs bij tab/click away --}}
<input type="text" wire:model.blur="email">
```

### Modifiers

```blade
{{-- Debounce (custom delay) --}}
wire:model.live.debounce.150ms="search"
wire:model.live.debounce.500ms="query"
wire:model.live.debounce.1000ms="filter"

{{-- Throttle (fixed interval) --}}
wire:model.live.throttle.500ms="search"

{{-- Type casting --}}
wire:model.number="age"           {{-- Force to number --}}
wire:model.boolean="active"       {{-- Force to boolean --}}

{{-- Fill (only when mounting) --}}
wire:model.fill="title"           {{-- Won't update after mount --}}

{{-- Lazy (deprecated, use default wire:model) --}}
wire:model.lazy="title"           {{-- Same as wire:model --}}
```

### Input Types

```blade
{{-- Text inputs --}}
<input type="text" wire:model="name">
<input type="email" wire:model="email">
<input type="password" wire:model="password">
<textarea wire:model="content"></textarea>

{{-- Checkbox --}}
<input type="checkbox" wire:model="accepted"> {{-- Boolean --}}
<input type="checkbox" wire:model="roles" value="admin"> {{-- Array --}}

{{-- Radio --}}
<input type="radio" wire:model="role" value="admin">
<input type="radio" wire:model="role" value="user">

{{-- Select --}}
<select wire:model="country">
    <option value="nl">Netherlands</option>
    <option value="be">Belgium</option>
</select>

{{-- Multiple select --}}
<select wire:model="countries" multiple>
    <option value="nl">Netherlands</option>
    <option value="be">Belgium</option>
</select>

{{-- File --}}
<input type="file" wire:model="photo">
<input type="file" wire:model="documents" multiple>
```

---

## 🖱️ wire:click

```blade
{{-- Basic --}}
<button wire:click="save">Save</button>

{{-- With parameters --}}
<button wire:click="delete({{ $post->id }})">Delete</button>
<button wire:click="update('title', 'New Title')">Update</button>

{{-- Prevent default --}}
<a href="#" wire:click.prevent="action">Link</a>

{{-- Stop propagation --}}
<div wire:click="outer">
    <button wire:click.stop="inner">Inner</button>
</div>

{{-- Self (only when clicked directly) --}}
<div wire:click.self="action">
    <button>This won't trigger parent</button>
</div>

{{-- Once (fire only once) --}}
<button wire:click.once="initialize">Initialize</button>

{{-- Debounce --}}
<button wire:click.debounce.500ms="search">Search</button>

{{-- Throttle --}}
<button wire:click.throttle.1s="update">Update</button>
```

---

## 📝 wire:submit

```blade
{{-- Basic (automatically prevents default) --}}
<form wire:submit="save">
    <button type="submit">Save</button>
</form>

{{-- Explicit prevent --}}
<form wire:submit.prevent="save">
    <!-- ... -->
</form>
```

---

## ⌨️ wire:keydown / wire:keyup

```blade
{{-- Basic --}}
<input wire:keydown="handleKey">
<input wire:keyup="handleKey">

{{-- Specific keys --}}
<input wire:keydown.enter="submit">
<input wire:keydown.escape="close">
<input wire:keydown.tab="next">
<input wire:keydown.space="toggle">

{{-- Arrow keys --}}
<input wire:keydown.up="previous">
<input wire:keydown.down="next">
<input wire:keydown.left="back">
<input wire:keydown.right="forward">

{{-- Modifier keys --}}
<input wire:keydown.shift.enter="submitSpecial">
<input wire:keydown.ctrl.s.prevent="save">
<input wire:keydown.cmd.k.prevent="search">
<input wire:keydown.alt.n="new">

{{-- Special characters --}}
<input wire:keydown.slash="search">      {{-- / --}}
<input wire:keydown.period="next">       {{-- . --}}
<input wire:keydown.equal="zoom">        {{-- = --}}
```

---

## ⏳ wire:loading

### Basic Usage

```blade
{{-- Shows during ANY component update --}}
<div wire:loading>Loading...</div>

{{-- Target specific action --}}
<button wire:click="save">Save</button>
<div wire:loading wire:target="save">Saving...</div>

{{-- Target specific property update --}}
<input wire:model.live="search">
<div wire:loading wire:target="search">Searching...</div>
```

### Modifiers

```blade
{{-- Remove element instead of hiding --}}
<div wire:loading.remove>Hide this</div>

{{-- CSS classes --}}
<div wire:loading.class="opacity-50">Fades during load</div>
<div wire:loading.class.remove="hidden">Shows during load</div>

{{-- Attributes --}}
<button wire:loading.attr="disabled">Can't click while loading</button>

{{-- Flex (maintains display:flex) --}}
<div wire:loading.flex>...</div>

{{-- Grid --}}
<div wire:loading.grid>...</div>

{{-- Inline --}}
<span wire:loading.inline>...</span>

{{-- Inline-block --}}
<span wire:loading.inline-block>...</span>

{{-- Inline-flex --}}
<span wire:loading.inline-flex>...</span>

{{-- Table --}}
<tr wire:loading.table>...</tr>
<td wire:loading.table-cell>...</td>
```

### Delays

```blade
<div wire:loading.delay>Loading...</div>                      {{-- 200ms --}}
<div wire:loading.delay.shortest>Loading...</div>             {{-- 50ms --}}
<div wire:loading.delay.shorter>Loading...</div>              {{-- 100ms --}}
<div wire:loading.delay.short>Loading...</div>                {{-- 150ms --}}
<div wire:loading.delay.long>Loading...</div>                 {{-- 200ms --}}
<div wire:loading.delay.longer>Loading...</div>               {{-- 300ms --}}
<div wire:loading.delay.longest>Loading...</div>              {{-- 400ms --}}
```

### Multiple Targets

```blade
<div wire:loading wire:target="save, delete, update">
    Processing...
</div>
```

---

## 🎨 wire:dirty

Shows when field has unsaved changes.

```blade
{{-- Show element when dirty --}}
<input wire:model="title">
<div wire:dirty wire:target="title">Unsaved changes</div>

{{-- Add CSS class when dirty --}}
<input wire:model="title" wire:dirty.class="border-yellow-500">

{{-- Remove CSS class when dirty --}}
<input wire:model="title" wire:dirty.class.remove="border-gray-300">

{{-- Add attribute when dirty --}}
<input wire:model="title" wire:dirty.attr="data-unsaved">
```

---

## ✅ wire:confirm

```blade
{{-- Basic confirmation --}}
<button 
    wire:click="delete" 
    wire:confirm="Are you sure?"
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

{{-- Multiple confirmations --}}
<button 
    wire:click="criticalAction"
    wire:confirm="Are you absolutely sure?"
    wire:confirm="This cannot be undone. Continue?"
>
    Critical Action
</button>
```

---

## 🚀 wire:navigate

SPA-like navigation zonder page refresh.

```blade
{{-- Basic navigation --}}
<a href="/posts" wire:navigate>Posts</a>

{{-- Prefetch on hover --}}
<a href="/posts" wire:navigate.hover>Posts</a>

{{-- External links (opens in new tab) --}}
<a href="https://laravel.com" wire:navigate>Laravel</a>
```

---

## 🎯 wire:current

Marks element as current/active page.

```blade
{{-- Add class to current page link --}}
<a 
    href="/posts" 
    wire:navigate 
    wire:current.class="text-blue-500 font-bold"
>
    Posts
</a>

{{-- Remove class on current page --}}
<a 
    href="/posts" 
    wire:navigate 
    wire:current.class.remove="text-gray-500"
>
    Posts
</a>
```

---

## 🔄 wire:poll

Auto-refresh component at intervals.

```blade
{{-- Poll every 2 seconds --}}
<div wire:poll.2s>
    Current time: {{ now() }}
</div>

{{-- Poll every 5 seconds --}}
<div wire:poll.5s="refresh">
    Data: {{ $data }}
</div>

{{-- Poll only when visible --}}
<div wire:poll.visible.5s="refresh">
    Only polls when on screen
</div>

{{-- Keep alive (prevent timeout) --}}
<div wire:poll.keep-alive>
    Prevents session timeout
</div>
```

---

## 🎬 wire:init

Calls action when component renders.

```blade
{{-- Call action on render --}}
<div wire:init="loadData">
    @if ($data)
        {{ $data }}
    @else
        Loading...
    @endif
</div>

{{-- Useful for lazy loading --}}
<div wire:init="loadExpensiveData">
    <div wire:loading wire:target="loadExpensiveData">
        Loading...
    </div>
    @if ($loaded)
        {{ $expensiveData }}
    @endif
</div>
```

---

## 👁️ wire:show / wire:hide

Conditionally show/hide with transitions.

```blade
{{-- Show when true --}}
<div wire:show="showAlert">
    Alert message
</div>

{{-- Hide when true --}}
<div wire:hide="hideContent">
    Content
</div>

{{-- With transitions --}}
<div wire:show="show" wire:transition>
    Fades in/out
</div>

<div wire:show="show" wire:transition.opacity>
    Opacity transition
</div>

<div wire:show="show" wire:transition.scale>
    Scale transition
</div>
```

---

## 🎭 wire:transition

Adds CSS transitions.

```blade
{{-- Default transition --}}
<div wire:transition>Content</div>

{{-- Opacity --}}
<div wire:transition.opacity>Fades</div>

{{-- Scale --}}
<div wire:transition.scale>Scales</div>

{{-- Duration --}}
<div wire:transition.duration.500ms>Slow transition</div>

{{-- Delay --}}
<div wire:transition.delay.200ms>Delayed</div>

{{-- Timing function --}}
<div wire:transition.ease>Ease</div>
<div wire:transition.ease-in>Ease in</div>
<div wire:transition.ease-out>Ease out</div>
<div wire:transition.linear>Linear</div>
```

---

## 🚫 wire:ignore

Prevents Livewire from updating this element.

```blade
{{-- Entire element ignored --}}
<div wire:ignore>
    <div id="map"></div>
</div>

{{-- Self only (children can update) --}}
<div wire:ignore.self>
    <div>This can update</div>
</div>

{{-- Common use: third-party JS libraries --}}
<div wire:ignore>
    <select id="choices-select">
        <!-- Choices.js will handle this -->
    </select>
</div>

@script
<script>
new Choices('#choices-select')
</script>
@endscript
```

---

## 🔄 wire:replace

Replace entire component on updates (useful for morphing issues).

```blade
<div wire:replace>
    {{-- Entire component replaced on update --}}
    <div id="external-library">...</div>
</div>
```

---

## 📡 wire:stream

Stream content updates (for AI/LLM streaming).

```blade
<div wire:stream="content">
    {{ $content }}
</div>

{{-- Append mode --}}
<div wire:stream.append="messages">
    {{ $latestMessage }}
</div>
```

---

## 📝 wire:text

Efficiently update text content without morphing.

```blade
<span wire:text="count">0</span>

{{-- Updates just the text, not the element --}}
<h1 wire:text="title">Loading...</h1>
```

---

## 🔇 wire:offline

Shows element when offline.

```blade
<div wire:offline>
    You are currently offline.
</div>

{{-- Add class when offline --}}
<div wire:offline.class="opacity-50">
    Content appears faded when offline
</div>
```

---

## 🎭 wire:cloak

Hides element until Livewire loads.

```blade
<div wire:cloak>
    {{-- Hidden until Livewire initializes --}}
    <button wire:click="action">Click me</button>
</div>

{{-- CSS needed: --}}
<style>
[wire\:cloak] { display: none !important; }
</style>
```

---

## 🔑 wire:key

**VERPLICHT in loops!** Helpt Livewire elementen tracken.

```blade
@foreach ($posts as $post)
    <div wire:key="post-{{ $post->id }}">
        {{ $post->title }}
    </div>
@endforeach

{{-- Ook voor nested components --}}
@foreach ($posts as $post)
    <livewire:post-item :post="$post" :key="$post->id" />
@endforeach

{{-- Met @livewire directive --}}
@foreach ($posts as $post)
    @livewire('post-item', ['post' => $post], key($post->id))
@endforeach
```

---

## 📦 Event Modifiers (All Directives)

Toepasbaar op wire:click, wire:keydown, etc.

```blade
.prevent          {{-- preventDefault() --}}
.stop             {{-- stopPropagation() --}}
.self             {{-- Only on this element --}}
.once             {{-- Fire once --}}
.debounce.500ms   {{-- Debounce (default 250ms) --}}
.throttle.500ms   {{-- Throttle (default 250ms) --}}
.window           {{-- Listen on window --}}
.document         {{-- Listen on document --}}
.outside          {{-- Clicks outside element --}}
.passive          {{-- Passive event listener --}}
.capture          {{-- Use capture phase --}}
.camel            {{-- camelCase event name --}}
.dot              {{-- dot.notation event name --}}
```

**Voorbeelden:**
```blade
<button wire:click.prevent.stop="save">Save</button>
<div wire:click.window="closeModal">...</div>
<div wire:click.outside="close">Modal</div>
<input wire:keydown.ctrl.s.prevent="save">
```

---

## 🎯 Combination Examples

### Form with all feedback

```blade
<form wire:submit="save">
    <input 
        wire:model.blur="title" 
        wire:loading.attr="readonly"
        wire:dirty.class="border-yellow-500"
    >
    @error('title') <span>{{ $message }}</span> @enderror
    <div wire:dirty wire:target="title">Unsaved</div>
    
    <button 
        type="submit"
        wire:loading.attr="disabled"
        wire:confirm="Save changes?"
    >
        <span wire:loading.remove wire:target="save">Save</span>
        <span wire:loading wire:target="save">Saving...</span>
    </button>
</form>
```

### Interactive list

```blade
@foreach ($items as $item)
    <div wire:key="item-{{ $item->id }}">
        <span wire:click="toggle({{ $item->id }})">
            {{ $item->name }}
        </span>
        
        <button 
            wire:click="delete({{ $item->id }})"
            wire:confirm="Delete {{ $item->name }}?"
            wire:loading.class="opacity-50"
            wire:target="delete({{ $item->id }})"
        >
            Delete
        </button>
    </div>
@endforeach
```

---

**Zie ook:**
- `/docs/livewire/livewire-core.md` - Component basics
- `/docs/livewire/livewire-forms.md` - Forms & validation
- `/docs/livewire/livewire-advanced.md` - Events & Alpine
- `/docs/livewire/livewire-patterns.md` - Common patterns
