<?php

namespace App\Policies;

use App\Models\Template;
use App\Models\User;
use App\Settings\SiteSettings;

class TemplatePolicy
{
    /**
     * Determine whether the user can view any templates.
     * Admins can see all templates, customers can access their own template resource.
     */
    public function viewAny(User $user): bool
    {
        // Admins can view all templates
        if ($user->isAdmin()) {
            return true;
        }

        // Customers with permission can access their scoped template resource
        return $user->can('view own template');
    }

    /**
     * Determine whether the user can view the template.
     * Admins can view all, customers only their site's template.
     */
    public function view(User $user, Template $template): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->can('view own template') && $this->isUserTemplate($template);
    }

    /**
     * Determine whether the user can create templates.
     * Only admins can create new templates.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the template.
     * Admins can update all, customers only their site's template.
     */
    public function update(User $user, Template $template): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->can('update own template') && $this->isUserTemplate($template);
    }

    /**
     * Determine whether the user can delete the template.
     * Only admins can delete templates.
     */
    public function delete(User $user, Template $template): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can bulk delete templates.
     * Only admins can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the template.
     * Only admins can restore.
     */
    public function restore(User $user, Template $template): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the template.
     * Only admins can force delete.
     */
    public function forceDelete(User $user, Template $template): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can manage template sections.
     */
    public function manageSections(User $user, Template $template): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->can('manage template sections') && $this->isUserTemplate($template);
    }

    /**
     * Determine whether the user can manage template navigation.
     */
    public function manageNavigation(User $user, Template $template): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->can('manage template navigation') && $this->isUserTemplate($template);
    }

    /**
     * Determine whether the user can manage template theme settings.
     */
    public function manageTheme(User $user, Template $template): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->can('manage template theme') && $this->isUserTemplate($template);
    }

    /**
     * Determine whether the user can manage template media.
     */
    public function manageMedia(User $user, Template $template): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->can('manage template media') && $this->isUserTemplate($template);
    }

    /**
     * Check if the template belongs to the current site.
     */
    private function isUserTemplate(Template $template): bool
    {
        $siteTemplateSlug = app(SiteSettings::class)->template_slug;

        return $template->slug === $siteTemplateSlug;
    }
}
