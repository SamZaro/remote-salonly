<div>
    @php
        // Determine which navbar variant to use
        $navbarVariant = $this->theme['navbar_variant'] ?? 'default';
        $navbarComponent = $navbarVariant === 'centered' ? 'components.partials.navbar-centered' : 'components.partials.navbar';
    @endphp

    @include($navbarComponent, [
        'theme' => $this->theme,
        'template' => $this->template,
        'navigation' => $this->navItems,
    ])
</div>
