# Filament 4.x Documentatie

> **Complete, praktische referentie voor Filament 4 - Server-Driven UI Framework voor Laravel**

## 📚 Overzicht

Deze documentatie biedt een complete, **praktische** referentie voor Filament 4.x, specifiek geschreven voor ervaren Laravel developers. Geen basis uitleg - alleen werkende code voorbeelden, best practices en pro tips.

### Wat is Filament?

Filament is een **Server-Driven UI (SDUI) framework** voor Laravel dat je toelaat om complete admin panels, dashboards en CRUD interfaces te bouwen met alleen PHP - geen JavaScript vereist. Gebouwd op Livewire, Alpine.js en Tailwind CSS.

**Kernfeatures:**
- Declaratieve form & table builders
- Resource management (CRUD)
- Actions & modals systeem
- Real-time notifications
- Widgets & dashboards
- Multi-tenancy support
- Extensible plugin systeem

---

## 📖 Documentatie Structuur

De documentatie is opgesplitst in **9 gespecialiseerde bestanden** voor optimale leesbaarheid en token efficiency:

| Bestand | Inhoud | Regels | Gebruik Voor |
|---------|--------|--------|--------------|
| **[filament-core.md](./filament-core.md)** | Resources, CRUD, Navigation, Authorization | ~450 | Resource setup, basic CRUD operaties |
| **[filament-tables.md](./filament-tables.md)** | Columns, Filters, Actions, Layout, Grouping | ~400 | Table configuratie, data weergave |
| **[filament-forms.md](./filament-forms.md)** | Form Fields, Validation, Schemas, Layouts | ~450 | Form building, input handling |
| **[filament-forms-validation.md](./filament-forms-validation.md)** | Validation Rules, Exists/Unique, Custom Rules | ~345 | Form validatie, database constraints |
| **[filament-forms-rich-editor.md](./filament-forms-rich-editor.md)** | RichEditor, TipTap, Custom Blocks, Mentions | ~710 | WYSIWYG editor, rich content |
| **[filament-actions.md](./filament-actions.md)** | Actions, Modals, Notifications, Infolists | ~350 | User interactions, feedback |
| **[filament-advanced.md](./filament-advanced.md)** | Widgets, Multi-tenancy, Styling, Custom Pages | ~400 | Dashboard widgets, theming, SaaS features |
| **[filament-custom-css.md](./filament-custom-css.md)** | Panel Styling, Kleuren, Fonts, CSS Hooks, Icons | ~640 | Custom branding, theming |
| **[filament-testing.md](./filament-testing.md)** | Testing, Deployment, Performance | ~250 | QA, production deployment |

**Totaal:** ~3.995 regels praktische documentatie met werkende voorbeelden.

---

## 🎯 Gebruik Scenarios

### Scenario 1: Nieuwe Resource Maken

```
Lees: filament-core.md (Resources sectie)
      filament-forms.md (Form Fields)
      filament-tables.md (Columns)
```

**Tokens:** ~3.500 (vs 15.000+ voor complete docs)

### Scenario 2: Table Optimaliseren

```
Lees: filament-tables.md (Columns, Filters, Actions)
      filament-core.md (Eloquent Query Optimization)
```

**Tokens:** ~2.000

### Scenario 3: Actions & Modals Implementeren

```
Lees: filament-actions.md (Actions, Modals)
      filament-forms.md (Form in Modals)
```

**Tokens:** ~1.800

### Scenario 4: Dashboard Met Widgets

```
Lees: filament-advanced.md (Widgets sectie)
      filament-tables.md (Table Widget)
```

**Tokens:** ~1.500

### Scenario 5: Multi-tenant SaaS Setup

```
Lees: filament-advanced.md (Multi-tenancy)
      filament-core.md (Authorization, Resource Scoping)
```

**Tokens:** ~2.200

### Scenario 6: Production Deployment

```
Lees: filament-testing.md (Deployment sectie)
      filament-advanced.md (Performance)
```

**Tokens:** ~1.000

### Scenario 7: Rich Text Editor Implementeren

```
Lees: filament-forms-rich-editor.md (RichEditor, toolbar, images)
      filament-forms.md (Form context)
```

**Tokens:** ~2.800

### Scenario 8: Form Validation Toevoegen

```
Lees: filament-forms-validation.md (Rules, exists/unique)
      filament-forms.md (Form Fields)
```

**Tokens:** ~2.200

### Scenario 9: Custom Panel Styling

```
Lees: filament-custom-css.md (Kleuren, fonts, CSS hooks)
      filament-advanced.md (Theming context)
```

**Tokens:** ~2.500

---

## 🚀 Quick Start

### 1. Installatie

```bash
composer require filament/filament:"^4.0"
php artisan filament:install --panels
php artisan make:filament-user
```

**Zie:** [filament-core.md - Installatie](./filament-core.md#installatie)

### 2. Eerste Resource

```bash
php artisan make:filament-resource Customer --generate
```

**Zie:** [filament-core.md - Resources](./filament-core.md#resources)

### 3. Table Configureren

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('email')->copyable(),
            TextColumn::make('created_at')->date(),
        ])
        ->filters([...])
        ->recordActions([...]);
}
```

**Zie:** [filament-tables.md](./filament-tables.md)

### 4. Form Definiëren

```php
public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('name')->required(),
            TextInput::make('email')->email(),
            Select::make('status')->options([...]),
        ]);
}
```

**Zie:** [filament-forms.md](./filament-forms.md)

---

## 💡 Pro Tips

### Token Efficiency

Modulaire docs = **50-80% minder tokens** per query:

| Vraag | Monolithisch | Modulair | Besparing |
|-------|-------------|----------|-----------|
| "Hoe maak ik een resource?" | 15.000 tokens | 3.500 tokens | 77% |
| "Table filter toevoegen?" | 15.000 tokens | 2.000 tokens | 87% |
| "Widget maken?" | 15.000 tokens | 1.500 tokens | 90% |
| "Production deploy?" | 15.000 tokens | 1.000 tokens | 93% |

### Best Practices

1. **Resource Classes Klein Houden**
   - Gebruik schema & table classes
   - Zie: [filament-core.md - Pro Tips](./filament-core.md#pro-tips)

2. **Query Optimization**
   - Eager loading
   - Zie: [filament-core.md - Eloquent Query](./filament-core.md#customizing-the-resource-eloquent-query)

3. **Conditional Fields**
   - Live validation
   - Zie: [filament-forms.md - Pro Tips](./filament-forms.md#pro-tips)

4. **Action Authorization**
   - Policy-based
   - Zie: [filament-core.md - Authorization](./filament-core.md#authorization)

5. **Performance**
   - Caching strategies
   - Zie: [filament-testing.md - Performance](./filament-testing.md#performance)

---

## 📚 Gerelateerde Resources

### Officiële Documentatie
- [Filament Docs](https://filamentphp.com/docs)
- [Livewire Docs](https://livewire.laravel.com/docs)
- [Laravel Docs](https://laravel.com/docs)

### Plugins
- [Filament Plugins](https://filamentphp.com/plugins)
- [Shield (Permissions)](https://filamentphp.com/plugins/bezhansalleh-shield)
- [Spatie Media Library](https://filamentphp.com/plugins/filament-spatie-media-library)

### Community
- [Discord](https://filamentphp.com/discord)
- [GitHub](https://github.com/filamentphp/filament)
- [Twitter](https://twitter.com/filamentphp)

---

## 🔍 Quick Reference

### Veelgebruikte Commands

```bash
# Resources
php artisan make:filament-resource Customer
php artisan make:filament-resource Customer --generate
php artisan make:filament-resource Customer --simple

# Relation Manager
php artisan make:filament-relation-manager CustomerResource orders title

# Pages
php artisan make:filament-page Settings

# Widgets
php artisan make:filament-widget StatsOverview --stats-overview
php artisan make:filament-widget OrdersChart --chart

# Users
php artisan make:filament-user

# Optimization
php artisan filament:optimize
php artisan icons:cache
```

### Veelgebruikte Patterns

**Resource met Policy:**
```php
// CustomerPolicy.php
public function viewAny(User $user): bool
{
    return $user->can('view_any_customer');
}
```

**Table met Actions:**
```php
->recordActions([
    EditAction::make(),
    DeleteAction::make(),
])
```

**Form met Validation:**
```php
TextInput::make('email')
    ->email()
    ->required()
    ->unique(ignoreRecord: true)
```

**Action met Modal:**
```php
Action::make('activate')
    ->form([...])
    ->action(fn ($data) => ...)
    ->requiresConfirmation()
```

**Widget met Stats:**
```php
Stat::make('Customers', Customer::count())
    ->description('32k increase')
    ->descriptionIcon('heroicon-m-arrow-trending-up')
    ->chart([7, 2, 10, 3, 15])
```

---

## 🔧 Troubleshooting

### Common Issues

**1. Resource niet zichtbaar in navigatie**
- Check `viewAny()` in policy
- Zie: [filament-core.md - Authorization](./filament-core.md#authorization)

**2. Form validation werkt niet**
- Check `rules()` in form field
- Zie: [filament-forms.md - Validation](./filament-forms.md#validation)

**3. Table te traag**
- Eager loading toevoegen
- Zie: [filament-tables.md - Pro Tips](./filament-tables.md#pro-tips)

**4. Actions niet zichtbaar**
- Check `visible()` en `authorize()`
- Zie: [filament-actions.md - Visibility](./filament-actions.md#actions-overview)

**5. Widget laadt niet**
- Check `$sort` en `$columnSpan`
- Zie: [filament-advanced.md - Widgets](./filament-advanced.md#widgets)

---

## 📊 Token Efficiency Tabel

| Documentatie Type | Tokens | Use Case |
|-------------------|---------|----------|
| **Complete Monoliet** | ~20.000 | Eerste keer lezen, volledige setup |
| **Core (Resources)** | ~3.500 | Resource maken, CRUD basis |
| **Tables** | ~2.500 | Table configuratie, filters |
| **Forms** | ~3.000 | Form building, validation |
| **Forms Validation** | ~2.200 | Validation rules, exists/unique |
| **Forms Rich Editor** | ~4.500 | WYSIWYG, custom blocks, mentions |
| **Actions** | ~2.200 | Actions, modals, notifications |
| **Advanced** | ~2.800 | Widgets, theming, multi-tenancy |
| **Custom CSS** | ~4.000 | Panel styling, kleuren, fonts, icons |
| **Testing** | ~1.800 | Testing, deployment |
| **Combinatie (2 files)** | ~5.000 | Meeste praktische vragen |
| **README (overview)** | ~700 | Quick reference, links |

**Gemiddelde besparing:** **70-85%** tokens per query door modulaire structuur.

---

## ✨ Features

### ✅ Wat deze docs bieden

- ✅ **Praktische voorbeelden** - Werkende code, geen theorie
- ✅ **Nederlandse taal** - Professioneel en to-the-point
- ✅ **Modulair opgebouwd** - Lees alleen wat je nodig hebt
- ✅ **Pro tips sectie** - Best practices van ervaren developers
- ✅ **Complete recipes** - Real-world voorbeelden
- ✅ **Cross-references** - Links naar gerelateerde secties
- ✅ **Token efficient** - 70-85% minder tokens per query
- ✅ **Up-to-date** - Filament 4.x (December 2025)

### ❌ Wat deze docs NIET doen

- ❌ Basis PHP/Laravel uitleg
- ❌ Livewire fundamentals
- ❌ Tailwind CSS guide
- ❌ Git/Composer tutorials
- ❌ Algemene programming concepten

**Deze docs zijn voor ervaren developers die direct aan de slag willen.**

---

## 🎓 Learning Path

### Beginner (Net gestart met Filament)

1. Lees [filament-core.md](./filament-core.md) (Resources, CRUD)
2. Bouw je eerste resource
3. Lees [filament-tables.md](./filament-tables.md) (Columns, Filters)
4. Lees [filament-forms.md](./filament-forms.md) (Form Fields)

**Tijd:** ~2 uur | **Tokens:** ~9.000

### Intermediate (Basis onder de knie)

5. Lees [filament-forms-validation.md](./filament-forms-validation.md) (Validation Rules)
6. Lees [filament-actions.md](./filament-actions.md) (Actions, Modals)
7. Implementeer custom actions
8. Lees [filament-advanced.md](./filament-advanced.md) (Widgets)
9. Bouw je eerste widget

**Tijd:** ~3 uur | **Tokens:** ~7.000

### Advanced (Production ready)

10. Lees [filament-custom-css.md](./filament-custom-css.md) (Styling, Theming)
11. Lees [filament-forms-rich-editor.md](./filament-forms-rich-editor.md) (RichEditor)
12. Lees [filament-testing.md](./filament-testing.md) (Testing, Deployment)
13. Schrijf tests voor je resources
14. Setup production deployment
15. Performance optimization

**Tijd:** ~3 uur | **Tokens:** ~8.500

**Totaal:** ~8 uur | ~24.500 tokens (vs 80.000+ met monolithische docs)

---

## 📝 Changelog

### v1.1.0 (Januari 2026)
- ✅ `filament-forms-validation.md` toegevoegd - Complete validation rules reference
- ✅ `filament-forms-rich-editor.md` toegevoegd - RichEditor/TipTap documentatie
- ✅ `filament-custom-css.md` toegevoegd - Panel styling en CSS hooks
- ✅ 9 gespecialiseerde documentatie bestanden (was 6)
- ✅ ~4.000 regels praktische voorbeelden (was ~2.300)

### v1.0.0 (December 2025)
- ✅ Initiële release
- ✅ 6 gespecialiseerde documentatie bestanden
- ✅ 2.300+ regels praktische voorbeelden
- ✅ Nederlandse vertaling
- ✅ Token efficiency optimalisatie
- ✅ Complete coverage Filament 4.x features

---

## 🤝 Contributing

Deze documentatie is onderdeel van een persoonlijk project. Voor officiële Filament documentatie, zie [filamentphp.com/docs](https://filamentphp.com/docs).

---

## 📄 License

Deze documentatie is gebaseerd op de officiële Filament documentatie (MIT License) en aangepast voor Nederlands + praktisch gebruik.

---

**Happy coding! 🚀**

Voor vragen over specifieke onderwerpen, lees het relevante bestand:
- Resources & CRUD → [filament-core.md](./filament-core.md)
- Tables & Filters → [filament-tables.md](./filament-tables.md)
- Forms & Fields → [filament-forms.md](./filament-forms.md)
- Form Validation → [filament-forms-validation.md](./filament-forms-validation.md)
- Rich Editor → [filament-forms-rich-editor.md](./filament-forms-rich-editor.md)
- Actions & Modals → [filament-actions.md](./filament-actions.md)
- Widgets & Multi-tenancy → [filament-advanced.md](./filament-advanced.md)
- Styling & Theming → [filament-custom-css.md](./filament-custom-css.md)
- Testing & Deploy → [filament-testing.md](./filament-testing.md)
