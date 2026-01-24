# DaisyUI v5 Quick Reference

> Voor Claude Code context - DaisyUI v5.x met Tailwind CSS v4 (2025)

## Installatie

```bash
npm i -D daisyui@latest
```

**CSS setup (Tailwind v4 style):**
```css
@import "tailwindcss";
@plugin "daisyui";
```

Geen `tailwind.config.js` meer nodig — alles via CSS.

---

## Configuratie

### Themes instellen

```css
@import "tailwindcss";
@plugin "daisyui" {
  themes: light --default, dark --prefersdark;
}
```

**Flags:**
- `--default` — standaard theme
- `--prefersdark` — theme voor `prefers-color-scheme: dark`

**Alle themes:**
```css
@plugin "daisyui" {
  themes: all;
}
```

**Specifieke themes:**
```css
@plugin "daisyui" {
  themes: light --default, dark --prefersdark, cupcake, nord, sunset;
}
```

### Include/Exclude componenten

```css
/* Alleen specifieke componenten */
@plugin "daisyui" {
  include: button, input, select, modal;
}

/* Componenten uitsluiten */
@plugin "daisyui" {
  exclude: scrollbar, rootscrollgutter;
}
```

### Prefix

```css
@plugin "daisyui" {
  prefix: d-;
}
```

### Root scope

```css
@plugin "daisyui" {
  root: #my-app;
}
```

---

## Custom Themes

### Nieuw theme maken

```css
@import "tailwindcss";
@plugin "daisyui";

@plugin "daisyui/theme" {
  name: "mytheme";
  default: true;
  prefersdark: false;
  color-scheme: light;

  --color-primary: oklch(49% 0.31 275);
  --color-primary-content: oklch(90% 0.06 275);
  --color-secondary: oklch(70% 0.33 342);
  --color-secondary-content: oklch(99% 0.01 342);
  --color-accent: oklch(77% 0.18 183);
  --color-accent-content: oklch(15% 0.04 183);
  --color-neutral: oklch(20% 0.02 255);
  --color-neutral-content: oklch(90% 0.01 252);

  --color-base-100: oklch(100% 0 0);
  --color-base-200: oklch(96% 0 0);
  --color-base-300: oklch(92% 0 0);
  --color-base-content: oklch(28% 0.03 256);

  --color-info: oklch(72% 0.19 231);
  --color-info-content: oklch(0% 0 0);
  --color-success: oklch(65% 0.15 160);
  --color-success-content: oklch(0% 0 0);
  --color-warning: oklch(85% 0.20 83);
  --color-warning-content: oklch(0% 0 0);
  --color-error: oklch(72% 0.22 22);
  --color-error-content: oklch(0% 0 0);

  --radius-box: 1rem;
  --radius-field: 0.5rem;
  --radius-selector: 1.5rem;
  --border: 1px;

  --size-field: 2.5rem;
  --size-selector: 1.5rem;

  --depth: 1;
  --noise: 0;
}
```

### Bestaand theme aanpassen

```css
@plugin "daisyui/theme" {
  name: "light";
  default: true;
  --color-primary: blue;
  --color-secondary: teal;
}
```

---

## Color Variables (v5 format)

| Variable | Beschrijving |
|----------|--------------|
| `--color-primary` | Primaire kleur |
| `--color-primary-content` | Tekst op primary |
| `--color-secondary` | Secundaire kleur |
| `--color-secondary-content` | Tekst op secondary |
| `--color-accent` | Accent kleur |
| `--color-accent-content` | Tekst op accent |
| `--color-neutral` | Neutrale kleur |
| `--color-neutral-content` | Tekst op neutral |
| `--color-base-100` | Achtergrond level 1 |
| `--color-base-200` | Achtergrond level 2 |
| `--color-base-300` | Achtergrond level 3 |
| `--color-base-content` | Standaard tekst |
| `--color-info` | Info kleur |
| `--color-success` | Success kleur |
| `--color-warning` | Warning kleur |
| `--color-error` | Error kleur |

---

## Design System Variables

```css
/* Grootte van fields (button, input, select, tab) */
--size-field: 2.5rem;

/* Grootte van selectors (checkbox, radio, toggle, badge) */
--size-selector: 1.5rem;

/* Border radius */
--radius-box: 1rem;      /* cards, modals */
--radius-field: 0.5rem;  /* buttons, inputs */
--radius-selector: 1.5rem; /* badges, toggles */

/* Border width */
--border: 1px;

/* Effects */
--depth: 1;  /* 0 of 1 - subtiele diepte */
--noise: 0;  /* 0 of 1 - textuur effect */
```

---

## Beschikbare Themes (35)

**Light themes:**
`light`, `cupcake`, `bumblebee`, `emerald`, `corporate`, `retro`, `valentine`, `garden`, `aqua`, `lofi`, `pastel`, `fantasy`, `wireframe`, `cmyk`, `autumn`, `acid`, `lemonade`, `winter`, `nord`, `caramellatte`, `silk`

**Dark themes:**
`dark`, `synthwave`, `cyberpunk`, `halloween`, `forest`, `black`, `luxury`, `dracula`, `business`, `night`, `coffee`, `dim`, `sunset`, `abyss`

---

## Components Overview

### Actions
- `btn` — Button
- `dropdown` — Dropdown menu
- `fab` — Floating Action Button (nieuw v5)
- `modal` — Modal dialog
- `swap` — Swap content
- `theme-controller` — Theme switcher

### Data Display
- `accordion` / `collapse` — Inklapbare content
- `avatar` — Avatar afbeelding
- `badge` — Badge/label
- `card` — Card container
- `carousel` — Image carousel
- `chat` — Chat bubble
- `countdown` — Countdown timer
- `diff` — Side-by-side vergelijking
- `hover-3d` — 3D hover effect (nieuw v5)
- `hover-gallery` — Hover image gallery (nieuw v5)
- `kbd` — Keyboard key
- `list` — List layout (nieuw v5)
- `stat` — Statistics
- `status` — Status indicator (nieuw v5)
- `table` — Table
- `text-rotate` — Rotating text (nieuw v5)
- `timeline` — Timeline

### Navigation
- `breadcrumbs` — Breadcrumb navigation
- `dock` — Bottom navigation (was `btm-nav`)
- `link` — Styled link
- `menu` — Menu list
- `navbar` — Navigation bar
- `pagination` — Pagination
- `steps` — Step indicator
- `tab` — Tabs

### Feedback
- `alert` — Alert message
- `loading` — Loading spinner
- `progress` — Progress bar
- `radial-progress` — Circular progress
- `skeleton` — Loading skeleton
- `toast` — Toast notification
- `tooltip` — Tooltip

### Data Input
- `calendar` — Calendar/datepicker styling
- `checkbox` — Checkbox
- `fieldset` — Form fieldset (nieuw v5)
- `file-input` — File upload
- `filter` — Filter radio group (nieuw v5)
- `input` — Text input
- `label` — Form label (nieuw v5)
- `radio` — Radio button
- `range` — Range slider
- `rating` — Star rating
- `select` — Select dropdown
- `textarea` — Textarea
- `toggle` — Toggle switch
- `validator` — Form validation (nieuw v5)

### Layout
- `divider` — Divider line
- `drawer` — Sidebar drawer
- `footer` — Page footer
- `hero` — Hero section
- `indicator` — Corner indicator
- `join` — Group items
- `mask` — Image mask
- `stack` — Stacked elements

---

## Component Voorbeelden

### Button

```html
<!-- Sizes -->
<button class="btn btn-xs">Extra Small</button>
<button class="btn btn-sm">Small</button>
<button class="btn btn-md">Medium</button>
<button class="btn btn-lg">Large</button>
<button class="btn btn-xl">Extra Large</button>

<!-- Colors -->
<button class="btn btn-primary">Primary</button>
<button class="btn btn-secondary">Secondary</button>
<button class="btn btn-accent">Accent</button>
<button class="btn btn-neutral">Neutral</button>
<button class="btn btn-info">Info</button>
<button class="btn btn-success">Success</button>
<button class="btn btn-warning">Warning</button>
<button class="btn btn-error">Error</button>

<!-- Styles -->
<button class="btn btn-outline">Outline</button>
<button class="btn btn-ghost">Ghost</button>
<button class="btn btn-link">Link</button>
<button class="btn btn-soft">Soft</button>      <!-- nieuw v5 -->
<button class="btn btn-dash">Dashed</button>    <!-- nieuw v5 -->

<!-- States -->
<button class="btn" disabled>Disabled</button>
<button class="btn btn-active">Active</button>
<button class="btn"><span class="loading loading-spinner"></span>Loading</button>
```

### Card

```html
<div class="card bg-base-100 w-96 shadow-sm">
  <figure>
    <img src="image.jpg" alt="Image" />
  </figure>
  <div class="card-body">
    <h2 class="card-title">
      Title
      <div class="badge badge-secondary">NEW</div>
    </h2>
    <p>Description text</p>
    <div class="card-actions justify-end">
      <button class="btn btn-primary">Buy Now</button>
    </div>
  </div>
</div>

<!-- Card sizes -->
<div class="card card-sm">...</div>
<div class="card card-md">...</div>
<div class="card card-lg">...</div>
<div class="card card-xl">...</div>

<!-- Card styles -->
<div class="card card-dash">...</div>  <!-- nieuw v5 -->
```

### Modal

```html
<!-- Method 1: dialog element -->
<button class="btn" onclick="my_modal.showModal()">Open</button>
<dialog id="my_modal" class="modal">
  <div class="modal-box">
    <h3 class="text-lg font-bold">Hello!</h3>
    <p class="py-4">Modal content</p>
    <div class="modal-action">
      <form method="dialog">
        <button class="btn">Close</button>
      </form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<!-- Positioning (nieuw v5) -->
<dialog class="modal modal-top">...</dialog>
<dialog class="modal modal-start">...</dialog>
<dialog class="modal modal-end">...</dialog>
```

### Form Elements

```html
<!-- Input met label (nieuw v5) -->
<fieldset class="fieldset">
  <legend class="fieldset-legend">Account</legend>

  <label class="label">
    <span>Email</span>
    <input type="email" class="input" placeholder="email@example.com" />
  </label>

  <label class="label">
    <span>Password</span>
    <input type="password" class="input" />
  </label>
</fieldset>

<!-- Floating label -->
<label class="floating-label">
  <input type="text" class="input" placeholder=" " />
  <span>Username</span>
</label>

<!-- Validator (nieuw v5) -->
<label class="label validator">
  <input type="email" class="input" required />
  <span class="validator-hint">Please enter a valid email</span>
</label>

<!-- Sizes -->
<input class="input input-xs" />
<input class="input input-sm" />
<input class="input input-md" />
<input class="input input-lg" />
<input class="input input-xl" />
```

### Dropdown (v5 met Popover API)

```html
<!-- Method 1: CSS-only -->
<div class="dropdown">
  <div tabindex="0" role="button" class="btn m-1">Click</div>
  <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
    <li><a>Item 1</a></li>
    <li><a>Item 2</a></li>
  </ul>
</div>

<!-- Method 2: Popover API (nieuw v5) -->
<button class="btn" popovertarget="dropdown1">Click</button>
<ul class="dropdown menu bg-base-100 rounded-box w-52 shadow-sm" popover id="dropdown1">
  <li><a>Item 1</a></li>
  <li><a>Item 2</a></li>
</ul>

<!-- Positions -->
<div class="dropdown dropdown-end">...</div>
<div class="dropdown dropdown-top">...</div>
<div class="dropdown dropdown-left">...</div>
<div class="dropdown dropdown-right">...</div>
<div class="dropdown dropdown-center">...</div>  <!-- nieuw v5 -->
```

### Dock (was btm-nav)

```html
<div class="dock">
  <button>
    <svg>...</svg>
    <span class="dock-label">Home</span>
  </button>
  <button class="dock-active">
    <svg>...</svg>
    <span class="dock-label">Search</span>
  </button>
  <button>
    <svg>...</svg>
    <span class="dock-label">Profile</span>
  </button>
</div>

<!-- Sizes -->
<div class="dock dock-xs">...</div>
<div class="dock dock-sm">...</div>
<div class="dock dock-md">...</div>
<div class="dock dock-lg">...</div>
<div class="dock dock-xl">...</div>
```

### List (nieuw v5)

```html
<ul class="list bg-base-100 rounded-box shadow-md">
  <li class="list-row">
    <div><img class="size-10 rounded-box" src="avatar.jpg" /></div>
    <div>
      <div>Title</div>
      <div class="text-xs text-base-content/60">Subtitle</div>
    </div>
    <button class="btn btn-ghost btn-square btn-sm">
      <svg>...</svg>
    </button>
  </li>
</ul>
```

### Status (nieuw v5)

```html
<span class="status status-success"></span>
<span class="status status-warning"></span>
<span class="status status-error"></span>
<span class="status status-info"></span>

<!-- Sizes -->
<span class="status status-xs"></span>
<span class="status status-sm"></span>
<span class="status status-md"></span>
<span class="status status-lg"></span>
<span class="status status-xl"></span>
```

### Filter (nieuw v5)

```html
<div class="filter">
  <input type="radio" name="filter" class="btn filter-reset" aria-label="All" />
  <input type="radio" name="filter" class="btn" aria-label="Electronics" />
  <input type="radio" name="filter" class="btn" aria-label="Clothing" />
  <input type="radio" name="filter" class="btn" aria-label="Books" />
</div>
```

---

## Breaking Changes v4 → v5

### Renamed Classes

| v4 | v5 |
|----|-----|
| `btm-nav` | `dock` |
| `btm-nav-label` | `dock-label` |
| `btm-nav-xs/sm/md/lg` | `dock-xs/sm/md/lg` |
| `card-compact` | `card-sm` |
| `disabled` (menu) | `menu-disabled` |
| `active` (menu) | `menu-active` |
| `focus` (menu) | `menu-focus` |
| `online` (avatar) | `avatar-online` |
| `offline` (avatar) | `avatar-offline` |
| `placeholder` (avatar) | `avatar-placeholder` |

### Removed Classes

- `form-control` → gebruik `fieldset`
- `btn-group` → gebruik `join`
- `input-group` → gebruik `join`
- `artboard`, `artboard-demo`, `phone-*` → gebruik Tailwind `w-*` / `h-*`
- `mask-parallelogram-*` → niet meer beschikbaar

### Theme Variables Renamed

| v4 | v5 |
|----|-----|
| `--p` | `--color-primary` |
| `--pc` | `--color-primary-content` |
| `--s` | `--color-secondary` |
| `--sc` | `--color-secondary-content` |
| `--a` | `--color-accent` |
| `--ac` | `--color-accent-content` |
| `--n` | `--color-neutral` |
| `--nc` | `--color-neutral-content` |
| `--b1` | `--color-base-100` |
| `--b2` | `--color-base-200` |
| `--b3` | `--color-base-300` |
| `--bc` | `--color-base-content` |
| `--in` | `--color-info` |
| `--su` | `--color-success` |
| `--wa` | `--color-warning` |
| `--er` | `--color-error` |
| `--rounded-box` | `--radius-box` |
| `--rounded-btn` | `--radius-field` |
| `--rounded-badge` | `--radius-selector` |
| `--border-btn` | `--border` |

### Removed Theme Variables

- `--animation-btn` (niet meer nodig)
- `--animation-input` (niet meer nodig)
- `--btn-focus-scale` (niet meer nodig)

---

## Size Modifiers

Alle componenten met sizes ondersteunen nu `xl`:

| Modifier | Field height | Selector height |
|----------|--------------|-----------------|
| `*-xs` | 24px | 16px |
| `*-sm` | 32px | 20px |
| `*-md` | 40px | 24px |
| `*-lg` | 48px | 28px |
| `*-xl` | 56px | 32px |

---

## Dark Mode Setup

### Met Tailwind dark: variant

```css
@import "tailwindcss";
@plugin "daisyui" {
  themes: winter --default, night --prefersdark;
}
@custom-variant dark (&:where([data-theme=night], [data-theme=night] *));
```

```html
<div class="p-4 dark:p-8">
  <!-- p-4 op winter, p-8 op night -->
</div>
```

### Theme switchen

```html
<!-- Via data-theme attribute -->
<html data-theme="dark">

<!-- Via theme-controller -->
<input type="checkbox" value="dark" class="toggle theme-controller" />
```

---

## CDN Usage

```html
<!-- Volledige library (34kb gzipped) -->
<link href="https://cdn.jsdelivr.net/npm/daisyui@5/daisyui.css" rel="stylesheet" />

<!-- Micro CSS files -->
<link href="https://cdn.jsdelivr.net/npm/daisyui@5/components/button.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/daisyui@5/components/card.css" rel="stylesheet" />
```

---

## Calendar Libraries Support

DaisyUI v5 biedt styling voor:
- **Cally** — Web component calendar
- **Pikaday** — Vanilla JS datepicker
- **React Day Picker** — React datepicker

---

## Links

- Docs: https://daisyui.com/docs/
- Components: https://daisyui.com/components/
- Theme Generator: https://daisyui.com/theme-generator/
- Upgrade Guide: https://daisyui.com/docs/upgrade/
- llms.txt: https://daisyui.com/llms.txt
