---
name: frontend-design
description: Create distinctive, production-grade frontend interfaces with high design quality for the Laravel ecosystem. Use this skill when the user asks to build web components, pages, landing pages, dashboards, Blade components, Livewire components, or when styling/beautifying any web UI. Generates creative, polished code using Laravel Blade, TailwindCSS 4, Alpine.js, and Livewire 3 that avoids generic AI aesthetics.
license: Complete terms in LICENSE.txt
---

This skill guides creation of distinctive, production-grade frontend interfaces that avoid generic "AI slop" aesthetics. Implement real working code with exceptional attention to aesthetic details and creative choices.

The user provides frontend requirements: a component, page, application, or interface to build. They may include context about the purpose, audience, or technical constraints.

## Tech Stack (strict)

All output MUST use the following stack. Never generate React, Vue, JSX, or other framework code.

- **Templates**: Laravel Blade (`.blade.php`), using Blade components (`<x-component>`, `@props`, `{{ $slot }}`) and layouts (`<x-layouts.app>`)
- **Styling**: TailwindCSS 4 — use `@theme` in CSS for design tokens (custom properties), utility-first classes in markup. No separate CSS files unless strictly necessary.
- **Client-side interactivity**: Alpine.js (`x-data`, `x-show`, `x-on`, `x-transition`, `x-bind`, `x-effect`, `x-ref`, `$watch`, `Alpine.store()`)
- **Server-side reactivity**: Livewire 3 (`wire:click`, `wire:model`, `wire:navigate`, `#[On]`, `#[Computed]`, lazy loading via `wire:init`)
- **Fonts**: Load via Google Fonts `<link>` in layout head or `@import` in CSS, then configure in TailwindCSS 4 `@theme { --font-display: "Font Name", serif; }`
- **Icons**: Blade Icons package (e.g. Heroicons via `<x-heroicon-o-arrow-right />`) or inline SVG
- **No React, Vue, JSX, Angular, Svelte** — all output must be native Blade/Alpine/Livewire compatible

## Design Thinking

Before coding, understand the context and commit to a BOLD aesthetic direction:
- **Purpose**: What problem does this interface solve? Who uses it?
- **Tone**: Pick an extreme: brutally minimal, maximalist chaos, retro-futuristic, organic/natural, luxury/refined, playful/toy-like, editorial/magazine, brutalist/raw, art deco/geometric, soft/pastel, industrial/utilitarian, etc. There are so many flavors to choose from. Use these for inspiration but design one that is true to the aesthetic direction.
- **Constraints**: Technical requirements (Laravel ecosystem, performance, accessibility, SEO).
- **Differentiation**: What makes this UNFORGETTABLE? What's the one thing someone will remember?

**CRITICAL**: Choose a clear conceptual direction and execute it with precision. Bold maximalism and refined minimalism both work - the key is intentionality, not intensity.

Then implement working code using Laravel Blade, TailwindCSS 4, and Alpine.js that is:
- Production-grade and functional
- Visually striking and memorable
- Cohesive with a clear aesthetic point-of-view
- Meticulously refined in every detail
- Properly structured as reusable Blade/Livewire components

## Component Structure

When building UI, follow this hierarchy:
1. **Blade layout** (`resources/views/layouts/app.blade.php`) — base HTML, font loading, shared meta
2. **Blade page views** (`resources/views/pages/`) — full page compositions
3. **Blade components** (`resources/views/components/`) — reusable UI elements (`<x-button>`, `<x-card>`, `<x-hero>`)
4. **Livewire components** (`app/Livewire/`) — for server-driven interactive sections (forms, tables, filters, modals)
5. **Alpine.js** — for purely client-side interactions (dropdowns, toggles, tabs, animations, scroll effects)

Always indicate file paths in code output so the user knows where each file belongs.

## Frontend Aesthetics Guidelines

Focus on:
- **Typography**: Choose fonts that are beautiful, unique, and interesting. Avoid generic fonts like Arial and Inter; opt instead for distinctive choices that elevate the frontend's aesthetics; unexpected, characterful font choices. Pair a distinctive display font with a refined body font. Define fonts in TailwindCSS 4 via `@theme { --font-display: "Font Name", serif; --font-body: "Font Name", sans-serif; }` and use them as `font-display` / `font-body` in classes.
- **Color & Theme**: Commit to a cohesive aesthetic. Use TailwindCSS 4 `@theme` for all design tokens as CSS custom properties. Dominant colors with sharp accents outperform timid, evenly-distributed palettes. Define a full palette: `--color-primary-*`, `--color-accent-*`, `--color-surface-*`, etc.
- **Motion**: Use Alpine.js transitions (`x-transition`, `x-show`, `x-cloak`) and TailwindCSS 4 animation utilities (`animate-*`, `transition-*`, custom `@keyframes` in `@theme`) for micro-interactions. For page-load animations, use Alpine.js with staggered `x-init` or `x-intersect` delays. For scroll-triggered reveals, use `x-intersect` (Alpine Intersect plugin). Focus on high-impact moments: one well-orchestrated page load with staggered reveals creates more delight than scattered micro-interactions.
- **Spatial Composition**: Unexpected layouts. Asymmetry. Overlap. Diagonal flow. Grid-breaking elements. Generous negative space OR controlled density. Use Tailwind's grid and flexbox utilities creatively — `col-span-*`, `row-span-*`, `-mt-*` for overlaps, `rotate-*` for angles.
- **Backgrounds & Visual Details**: Create atmosphere and depth rather than defaulting to solid colors. Add contextual effects and textures that match the overall aesthetic. Apply creative forms like gradient meshes, noise textures (SVG filters or CSS), geometric patterns, layered transparencies, dramatic shadows (`shadow-*`, `drop-shadow-*`), decorative borders, and grain overlays.

## Design Tokens via TailwindCSS 4 @theme

Always define design tokens in the project's CSS using TailwindCSS 4's `@theme` directive. This ensures consistency and easy theming:

```css
/* resources/css/app.css */
@import "tailwindcss";

@theme {
    /* Typography */
    --font-display: "Playfair Display", serif;
    --font-body: "Source Sans 3", sans-serif;

    /* Colors — define as full palette */
    --color-primary: #1a1a2e;
    --color-accent: #e94560;
    --color-surface: #fafaf9;
    --color-surface-alt: #f0ede8;
    --color-muted: #6b7280;

    /* Spacing overrides (optional) */
    --spacing-section: 6rem;

    /* Custom animations */
    --animate-fade-up: fade-up 0.6s ease-out both;
}

@keyframes fade-up {
    from { opacity: 0; transform: translateY(1.5rem); }
    to { opacity: 1; transform: translateY(0); }
}
```

These tokens are then usable as standard Tailwind classes: `font-display`, `text-primary`, `bg-surface`, `animate-fade-up`, etc.

## Anti-Patterns (NEVER do this)

- NEVER use generic AI-generated aesthetics like overused font families (Inter, Roboto, Arial, system fonts), cliched color schemes (particularly purple gradients on white backgrounds), predictable layouts and component patterns, and cookie-cutter design that lacks context-specific character.
- NEVER generate React, Vue, or JSX code.
- NEVER use `@apply` excessively — prefer utility classes in markup for readability and maintainability.
- NEVER use JavaScript animation libraries (GSAP, Framer Motion, etc.) — stick to Alpine.js transitions and CSS/Tailwind animations.
- NEVER converge on common font choices (Space Grotesk, for example) across different designs. Each design should have its own typographic identity.

Interpret creatively and make unexpected choices that feel genuinely designed for the context. No design should be the same. Vary between light and dark themes, different fonts, different aesthetics.

**IMPORTANT**: Match implementation complexity to the aesthetic vision. Maximalist designs need elaborate code with extensive animations and effects. Minimalist or refined designs need restraint, precision, and careful attention to spacing, typography, and subtle details. Elegance comes from executing the vision well.

Remember: Claude is capable of extraordinary creative work. Don't hold back, show what can truly be created when thinking outside the box and committing fully to a distinctive vision — within the Laravel/Blade/Tailwind/Alpine ecosystem.
