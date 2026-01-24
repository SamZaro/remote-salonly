# Livewire 3.x Documentation

Complete Livewire 3.x referentie voor Claude Code, opgesplitst in gespecialiseerde modules voor efficiënt token gebruik.

---

## 📚 Documentatie Structuur

### 🎯 [livewire-core.md](livewire-core.md) (~300 regels)
**Laad dit altijd voor basiswerk met Livewire**

Bevat:
- Component creatie & rendering
- Properties & data binding
- Actions & event listeners
- Lifecycle hooks basics
- Security essentials
- wire:key in loops

**Gebruik voor:**
- Nieuwe componenten maken
- Property binding
- Basic actions
- Event handling

---

### 📝 [livewire-forms.md](livewire-forms.md) (~270 regels)
**Laad bij formulier gerelateerde taken**

Bevat:
- Form submission & handling
- Validation (inline, real-time, custom)
- Form objects
- File uploads
- Multi-step forms
- Conditional validation

**Gebruik voor:**
- Forms bouwen
- Validatie implementeren
- File uploads
- Form objects

---

### 🚀 [livewire-advanced.md](livewire-advanced.md) (~350 regels)
**Laad voor complexe features en integraties**

Bevat:
- Events system (dispatch/listen)
- Alpine integration ($wire, entangle)
- JavaScript API (@script, @assets)
- Computed properties
- Pagination
- URL query parameters
- Session properties
- Lazy loading
- Laravel Echo (WebSockets)

**Gebruik voor:**
- Component communicatie via events
- Alpine.js integratie
- JavaScript interactions
- Complex state management
- Real-time features

---

### 🎨 [livewire-directives.md](livewire-directives.md) (~280 regels)
**Quick reference voor alle wire:* directives**

Bevat:
- wire:model (alle modifiers)
- wire:click, wire:submit
- wire:loading (targets, delays)
- wire:dirty, wire:confirm
- wire:navigate, wire:current
- wire:poll, wire:init
- wire:show/hide, wire:transition
- wire:ignore, wire:key
- Alle event modifiers

**Gebruik voor:**
- Directive opzoeken
- Modifiers checken
- Event handling reference

---

### 🎯 [livewire-patterns.md](livewire-patterns.md) (~350 regels)
**Concrete voorbeelden en troubleshooting**

Bevat:
- Common UI patterns (modals, search, master-detail, tabs, infinite scroll, bulk actions)
- Security best practices
- Testing examples
- Troubleshooting guide
- Performance tips

**Gebruik voor:**
- Concrete implementatie voorbeelden
- Security checks
- Testing setup
- Debug hulp
- Performance optimalisatie

---

## 🎯 Gebruik Scenario's

### Scenario 1: Simpel Component Maken
**Laad:** `livewire-core.md`
```php
// Voorbeeld: Posts lijst met delete
class ShowPosts extends Component
{
    public function delete($id) { ... }
}
```

### Scenario 2: Form met Validatie
**Laad:** `livewire-core.md` + `livewire-forms.md`
```php
// Voorbeeld: CreatePost met validatie
#[Validate('required|min:5')]
public $title = '';
```

### Scenario 3: Modal met Events
**Laad:** `livewire-core.md` + `livewire-advanced.md` + `livewire-patterns.md`
```php
// Voorbeeld: Modal pattern met event dispatching
$this->dispatch('post-created')->to(Dashboard::class);
```

### Scenario 4: Search met Filters
**Laad:** `livewire-core.md` + `livewire-patterns.md`
```php
// Voorbeeld: Search & filter pattern
#[Url]
public $search = '';
```

### Scenario 5: Complex Form met File Upload
**Laad:** `livewire-core.md` + `livewire-forms.md`
```php
// Voorbeeld: Multi-step form met file upload
use WithFileUploads;
```

---

## 🔍 Quick Lookup

### Meest Gebruikte Features

**Data Binding:**
```blade
wire:model="property"          → livewire-core.md
wire:model.live="search"       → livewire-core.md
wire:model.blur="email"        → livewire-core.md
```

**Actions:**
```blade
wire:click="save"              → livewire-core.md
wire:submit="save"             → livewire-core.md
wire:keydown.enter="submit"    → livewire-directives.md
```

**Loading States:**
```blade
wire:loading                   → livewire-directives.md
wire:loading.delay             → livewire-directives.md
```

**Validation:**
```php
#[Validate('required')]        → livewire-forms.md
$this->validate()              → livewire-forms.md
```

**Events:**
```php
$this->dispatch('event')       → livewire-advanced.md
#[On('event')]                 → livewire-advanced.md
```

**UI Patterns:**
```
Modal                          → livewire-patterns.md
Search & Filter                → livewire-patterns.md
Master-Detail                  → livewire-patterns.md
```

---

## 📊 Token Efficiëntie

| Scenario | Files | ~Regels | Tokens |
|----------|-------|---------|--------|
| Basic component | core | 300 | ~1.5k |
| Form met validatie | core + forms | 570 | ~2.8k |
| Complex met events | core + advanced | 650 | ~3.2k |
| Alles | alle 5 | 1550 | ~7.5k |

Vergelijk met origineel: 1469 regels in 1 bestand = ~7.5k tokens altijd

---

## 🔗 Externe Links

- **Officiele Docs**: https://livewire.laravel.com/docs/3.x
- **GitHub**: https://github.com/livewire/livewire
- **Screencasts**: https://livewire.laravel.com/screencasts

---

## 💡 Tips

1. **Start altijd met livewire-core.md** - bevat de essentials
2. **Laad alleen wat je nodig hebt** - bespaar tokens
3. **Gebruik livewire-directives.md als reference** - voor quick lookup
4. **Check livewire-patterns.md voor concrete voorbeelden** - als je vast zit
5. **Valideer & autoriseer ALTIJD** - security first!

---

**Versie**: 3.x (Updated: December 2024)
**Bron**: Officiële Livewire 3.x documentatie
