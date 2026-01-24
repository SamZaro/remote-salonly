# Claude Code Documentation

Deze docs worden **niet standaard geladen** - alleen on-demand bij specifieke vragen.

## Beschikbare Reference Docs

### Laravel Best Practices
- `laravel-boost.md` - Volledige Laravel/Livewire/Filament/PHP/Tailwind best practices & conventions

### Livewire 3.x (Modulair - ~1.550 regels)
- `livewire/README.md` - Overzicht, gebruik scenario's, quick lookup guide
- `livewire/livewire-core.md` (~300 regels) - Component essentials, properties, actions, lifecycle
- `livewire/livewire-forms.md` (~270 regels) - Forms, validatie, file uploads, multi-step
- `livewire/livewire-advanced.md` (~350 regels) - Events, Alpine integratie, JS API, pagination
- `livewire/livewire-directives.md` (~280 regels) - Complete wire:* directive reference
- `livewire/livewire-patterns.md` (~350 regels) - UI patterns, testing, troubleshooting

### Filament 4.x (Modulair - ~4.400 regels)
- `filament/README.md` - Overzicht, gebruik scenario's, best practices, troubleshooting
- `filament/filament-core.md` (~450 regels) - Resources, CRUD, Navigation, Authorization
- `filament/filament-tables.md` (~400 regels) - Columns, Filters, Actions, Layout, Grouping
- `filament/filament-forms.md` (~450 regels) - Form Fields, Validation, Schemas, Layouts
- `filament/filament-forms-validation.md` (~345 regels) - Validation rules, exists/unique, custom rules
- `filament/filament-forms-rich-editor.md` (~710 regels) - RichEditor/TipTap, toolbar, custom blocks, mentions
- `filament/filament-actions.md` (~350 regels) - Actions, Modals, Notifications, Infolists
- `filament/filament-advanced.md` (~400 regels) - Widgets, Multi-tenancy, Styling, Custom Pages
- `filament/filament-custom-css.md` (~640 regels) - Panel styling, kleuren, fonts, CSS hooks, icons
- `filament/filament-testing.md` (~250 regels) - Testing, Deployment, Performance

### Filament Plugins
- `spatie-media-library.md` - Spatie Media Library v4 - File uploads, collections, conversions, responsive images

### Tailwind CSS 4.1
- `tailwindcss.md` - Tailwind CSS 4.1 documentatie - CSS-first configuratie, nieuwe utilities, theme variabelen, v3 naar v4 migratie

### DaisyUI 5.x
- `DAISYUI-V5.md` (~400 regels) - Quick reference voor DaisyUI v5 met Tailwind CSS v4, componenten, themes, configuratie
- `DAISYUI-LLMS.md` (~1.500 regels) - Uitgebreide LLM-optimized documentatie - alle componenten, classes, modifiers, colors

## Gebruik in Claude Code

**Vanaf project root** gebruik je altijd het `docs/` prefix:

```bash
# Specifiek bestand laden
"Lees docs/laravel-boost.md voor Filament 4 best practices"

# Livewire 3.x (modulair - start altijd met README)
"Lees docs/livewire/README.md voor Livewire scenario's"
"Lees docs/livewire/livewire-core.md voor component basics"
"Lees docs/livewire/livewire-forms.md voor form validatie"
"Lees docs/livewire/livewire-advanced.md voor events en Alpine integratie"
"Lees docs/livewire/livewire-patterns.md voor concrete voorbeelden"

# Filament 4.x (modulair - start altijd met README)
"Lees docs/filament/README.md voor Filament overzicht en scenario's"
"Lees docs/filament/filament-core.md voor Resource en CRUD setup"
"Lees docs/filament/filament-tables.md voor table configuratie en filters"
"Lees docs/filament/filament-forms.md voor form building en validatie"
"Lees docs/filament/filament-forms-validation.md voor validation rules en exists/unique"
"Lees docs/filament/filament-forms-rich-editor.md voor RichEditor, TipTap en custom blocks"
"Lees docs/filament/filament-actions.md voor actions en modals"
"Lees docs/filament/filament-advanced.md voor widgets en multi-tenancy"
"Lees docs/filament/filament-custom-css.md voor panel styling, kleuren en CSS hooks"

# Tailwind CSS 4.1
"Lees docs/tailwindcss.md voor Tailwind CSS 4.1 utilities en configuratie"

# DaisyUI 5.x
"Lees docs/DAISYUI-V5.md voor DaisyUI quick reference en configuratie"
"Lees docs/DAISYUI-LLMS.md voor complete DaisyUI component referentie"

# Meerdere bestanden
"Lees docs/livewire/livewire-core.md en docs/livewire/livewire-forms.md voor form component"
"Lees docs/filament/filament-core.md en docs/filament/filament-forms.md voor nieuwe resource"

# Alle bestanden in folder
"Lees alle bestanden in docs/livewire/ voor complete Livewire referentie"
"Lees alle bestanden in docs/filament/ voor complete Filament referentie"
```

**Let op**: Gebruik altijd forward slashes (`/`), niet backslashes (`\`)!

## Token Efficiency

**Zonder on-demand docs**: ~42k tokens per request (alle docs altijd geladen)
**Met on-demand docs**: ~6k tokens gemiddeld (alleen relevante docs)

**Besparing**: ~83% minder tokens door selectief laden

### Modulaire Docs Token Besparing

**Livewire 3.x**:
- Complete folder: ~1.550 regels (~7.5k tokens)
- Single module: ~300 regels (~1.5k tokens)
- Besparing: 70-85% door modulair laden

**Filament 4.x**:
- Complete folder: ~4.400 regels (~22k tokens)
- Single module: ~400 regels (~2.5k tokens)
- Besparing: 70-85% door modulair laden

**Best practice**: Start altijd met README.md van een folder om te bepalen welke modules je nodig hebt.

## Toekomstige Docs (TODO)

- `api-conventions.md` - API response formats, REST conventions
- `testing-guide.md` - PHPUnit conventions, test factories, coverage requirements
