# Tailwind CSS v4.1 Quick Reference

> Voor Claude Code context - Tailwind v4.1.x (2025)

## Installatie

```bash
# Vite (aanbevolen)
npm i tailwindcss @tailwindcss/vite

# PostCSS
npm i tailwindcss @tailwindcss/postcss

# CLI
npm i tailwindcss @tailwindcss/cli
```

**Vite config:**
```js
import tailwindcss from "@tailwindcss/vite";
export default { plugins: [tailwindcss()] };
```

**CSS entry:**
```css
@import "tailwindcss";
```

Geen `tailwind.config.js` meer nodig - alles via CSS.

---

## @theme Directive (CSS-first config)

Theme variables definiëren design tokens én genereren utility classes:

```css
@import "tailwindcss";

@theme {
  /* Kleuren → bg-brand, text-brand-light, etc. */
  --color-brand: #3b82f6;
  --color-brand-light: oklch(0.8 0.15 250);

  /* Fonts → font-display */
  --font-display: "Satoshi", sans-serif;

  /* Spacing → w-128, p-128, m-128, etc. */
  --spacing-128: 32rem;

  /* Breakpoints → 3xl:flex */
  --breakpoint-3xl: 1920px;

  /* Shadows → shadow-soft */
  --shadow-soft: 0 2px 8px rgba(0,0,0,0.1);

  /* Border radius → rounded-xl */
  --radius-xl: 1rem;

  /* Easing → ease-fluid */
  --ease-fluid: cubic-bezier(0.3, 0, 0, 1);

  /* Text shadow (v4.1) → text-shadow-brand */
  --text-shadow-brand: 0 2px 4px rgba(0,0,0,0.3);
}
```

### Theme Namespaces

| Namespace | Utilities | Voorbeeld |
|-----------|-----------|-----------|
| `--color-*` | `bg-`, `text-`, `border-`, `fill-`, `stroke-` | `--color-primary` → `bg-primary` |
| `--font-*` | `font-` | `--font-display` → `font-display` |
| `--spacing-*` | `p-`, `m-`, `w-`, `h-`, `gap-` | `--spacing-18` → `p-18` |
| `--breakpoint-*` | responsive variants | `--breakpoint-3xl` → `3xl:` |
| `--shadow-*` | `shadow-` | `--shadow-soft` → `shadow-soft` |
| `--radius-*` | `rounded-` | `--radius-xl` → `rounded-xl` |
| `--ease-*` | `ease-` | `--ease-bounce` → `ease-bounce` |
| `--text-shadow-*` | `text-shadow-` | `--text-shadow-lg` → `text-shadow-lg` |
| `--drop-shadow-*` | `drop-shadow-` | (v4.1 supports colors) |

### @theme inline (voor dark mode)

```css
:root {
  --background: hsl(0 0% 100%);
  --foreground: hsl(0 0% 3.9%);
}

.dark {
  --background: hsl(0 0% 3.9%);
  --foreground: hsl(0 0% 98%);
}

@theme inline {
  --color-background: var(--background);
  --color-foreground: var(--foreground);
}
```

---

## Directives

### @source - Content detection

```css
/* Extra sources toevoegen */
@source "../node_modules/@my-company/ui";

/* Uitsluiten (v4.1) */
@source not "./src/legacy";

/* Safelist (v4.1) */
@source inline("underline");
@source inline("{hover:,}bg-red-{100..900..100}");
@source not inline("container");
```

### @utility - Custom utilities

```css
@utility tab-4 {
  tab-size: 4;
}

/* Component-style utility */
@utility btn {
  border-radius: 0.5rem;
  padding: 0.5rem 1rem;
  background-color: ButtonFace;
}
```

### @variant - Variants toepassen

```css
.my-element {
  @variant hover {
    background: red;
  }
  @variant dark {
    background: black;
  }
}
```

### @custom-variant - Eigen variants

```css
/* Dark mode via class */
@custom-variant dark (&:where(.dark, .dark *));

/* Custom theme variants */
@custom-variant theme-ocean (&:where([data-theme="ocean"], [data-theme="ocean"] *));
```

### @reference - Voor Vue/Svelte/CSS Modules

```vue
<style>
  @reference "../../app.css";
  h1 { @apply text-2xl font-bold; }
</style>
```

### @config / @plugin (legacy)

```css
@config "../../tailwind.config.js";
@plugin "@tailwindcss/typography";
```

---

## Breaking Changes v3 → v4

### Renamed Utilities

| v3 | v4 |
|----|-----|
| `shadow-sm` | `shadow-xs` |
| `shadow` | `shadow-sm` |
| `blur-sm` | `blur-xs` |
| `blur` | `blur-sm` |
| `rounded-sm` | `rounded-xs` |
| `rounded` | `rounded-sm` |
| `ring` | `ring-3` |
| `outline-none` | `outline-hidden` |
| `bg-gradient-*` | `bg-linear-*` |

### Removed (use opacity modifiers)

```html
<!-- v3 -->
<div class="bg-black bg-opacity-50">

<!-- v4 -->
<div class="bg-black/50">
```

### Arbitrary Values Syntax

```html
<!-- v3 -->
<div class="bg-[--brand-color]">

<!-- v4 -->
<div class="bg-(--brand-color)">
```

### Important Modifier

```html
<!-- v3 -->
<div class="!bg-red-500">

<!-- v4 (beide werken, nieuw preferred) -->
<div class="bg-red-500!">
```

### Variant Stacking (links naar rechts)

```html
<!-- v3: rechts naar links -->
<ul class="first:*:pt-0">

<!-- v4: links naar rechts -->
<ul class="*:first:pt-0">
```

### Defaults Changed

- `border` → gebruikt nu `currentColor` (was `gray-200`)
- `ring` → 1px `currentColor` (was 3px `blue-500`)
- `hover:` → alleen bij `(hover: hover)` devices

---

## Nieuwe Features v4.0

### Container Queries

```html
<div class="@container">
  <div class="@sm:grid-cols-3 @lg:grid-cols-4 @max-md:hidden">
  <div class="@min-md:@max-xl:flex">
</div>
```

### Dynamic Values

```html
<!-- Geen config nodig -->
<div class="grid-cols-15">
<div class="mt-17 w-29">
<div class="data-current:opacity-100">
```

### Gradient Angles & Interpolation

```html
<div class="bg-linear-45 from-indigo-500 to-pink-500">
<div class="bg-linear-to-r/oklch from-blue-500 to-teal-400">
<div class="bg-conic from-red-600 to-red-600">
<div class="bg-radial-[at_25%_25%] from-white to-zinc-900">
```

### 3D Transforms

```html
<div class="perspective-distant">
  <div class="rotate-x-12 rotate-y-6 translate-z-4 transform-3d">
</div>
```

### @starting-style (enter animations)

```html
<div popover class="transition-discrete starting:open:opacity-0">
```

### not-* Variant

```html
<div class="not-hover:opacity-75">
<div class="not-supports-hanging-punctuation:px-4">
```

### Nieuwe Utilities

- `inset-shadow-*`, `inset-ring-*` — gestapelde shadows
- `field-sizing-content` — auto-resize textarea
- `color-scheme-dark` — native dark scrollbars
- `font-stretch-*` — variable font widths
- `size-*` — width + height combined

### Nieuwe Variants

- `inert:` — voor `inert` attribute
- `nth-*:` — nth-child targeting
- `in-*:` — implicit group (geen `group` class nodig)
- `open:` — ook voor popovers

---

## Nieuwe Features v4.1

### Text Shadows

```html
<p class="text-shadow-sm">
<p class="text-shadow-lg text-shadow-blue-500">
<p class="text-shadow-lg/50">  <!-- opacity -->
```

Sizes: `text-shadow-2xs`, `text-shadow-xs`, `text-shadow-sm`, `text-shadow-md`, `text-shadow-lg`

### Masking

```html
<div class="mask-t-from-50%">
<div class="mask-radial-from-80%">
<div class="mask-b-from-50% mask-radial-[50%_90%]">
```

### Colored Drop Shadows

```html
<svg class="drop-shadow-xl drop-shadow-cyan-500/50">
```

### Device Targeting

```html
<div class="pointer-fine:p-2 pointer-coarse:p-4">
<div class="any-pointer-coarse:touch-target">
```

### Overflow Wrap

```html
<p class="wrap-break-word">
<p class="wrap-anywhere">  <!-- flex-safe -->
```

### Safe Alignment

```html
<div class="justify-center-safe">  <!-- geen overflow beide kanten -->
```

### Baseline Alignment

```html
<div class="items-baseline-last">
<div class="self-baseline-last">
```

### Nieuwe Variants v4.1

- `details-content:` — style `<details>` content
- `inverted-colors:` — OS inverted colors mode
- `noscript:` — wanneer JS disabled
- `user-valid:` / `user-invalid:` — form validation na interactie

---

## Dark Mode

### Optie 1: System preference (default)

```html
<div class="dark:bg-gray-900">
```

### Optie 2: Class-based

```css
@custom-variant dark (&:where(.dark, .dark *));
```

```html
<html class="dark">
  <div class="dark:bg-gray-900">
```

### Optie 3: CSS Variables (aanbevolen voor theming)

```css
:root {
  --color-bg: white;
  --color-text: black;
}
.dark {
  --color-bg: #111;
  --color-text: white;
}
@theme inline {
  --color-background: var(--color-bg);
  --color-foreground: var(--color-text);
}
```

---

## Best Practices

### 1. Gebruik CSS variables voor theming

```css
@theme {
  --color-primary: var(--brand-primary, #3b82f6);
}
```

### 2. OKLCH voor levendige kleuren

```css
@theme {
  --color-accent: oklch(0.7 0.25 250);
}
```

### 3. Spacing scale via base variable

```css
@theme {
  --spacing: 0.25rem;  /* base unit */
}
/* Alle spacing utilities: calc(var(--spacing) * N) */
```

### 4. @apply sparend gebruiken

```css
/* Prefer: direct CSS met theme vars */
.btn {
  padding: var(--spacing-4) var(--spacing-6);
  background: var(--color-primary);
}

/* OK voor complexe utility combinations */
@utility btn {
  @apply rounded-lg px-4 py-2 font-medium;
}
```

### 5. Container queries voor component-based responsive

```html
<article class="@container">
  <div class="@md:flex @md:gap-4">
```

---

## Browser Support

**Minimaal vereist:**
- Safari 16.4+
- Chrome 111+
- Firefox 128+

v4.1 heeft betere fallbacks voor oudere browsers, maar core features vereisen moderne browsers.

---

## Migratie Commando

```bash
npx @tailwindcss/upgrade
```

Dit update automatisch:
- Dependencies
- Config naar CSS
- Renamed utilities
- Syntax changes

---

## Links

- Docs: https://tailwindcss.com/docs
- Playground: https://play.tailwindcss.com
- Upgrade Guide: https://tailwindcss.com/docs/upgrade-guide
