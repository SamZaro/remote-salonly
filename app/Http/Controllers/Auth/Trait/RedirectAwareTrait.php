<?php

namespace App\Http\Controllers\Auth\Trait;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;

trait RedirectAwareTrait
{
    protected function getRedirectUrl(?User $user): string
    {
        // Change this if you want to redirect to a different page after login

        if (! $user) {
            return route('filament.dashboard.pages.dashboard');
        }

        $intendedUrl = Redirect::getIntendedUrl();
        $homeUrl = rtrim(route('filament.dashboard.pages.dashboard'), '/');
        $baseUrl = rtrim(url('/'), '/');
        $adminUrl = rtrim(route('filament.admin.pages.dashboard'), '/');

        // Only use intended URL if it's set and not the home, base, or admin URL
        // Also filter out asset URLs (favicon, css, js, images, etc.)
        if ($intendedUrl !== null
            && rtrim($intendedUrl, '/') !== $homeUrl
            && rtrim($intendedUrl, '/') !== $baseUrl
            && rtrim($intendedUrl, '/') !== $adminUrl
            && ! $this->isAssetUrl($intendedUrl)) {
            return $intendedUrl;
        }

        if ($user->is_admin) {
            return route('filament.admin.pages.dashboard');
        }

        return route('filament.dashboard.pages.dashboard');
    }

    protected function isAssetUrl(string $url): bool
    {
        // Common asset extensions and paths to filter out
        $assetPatterns = [
            '/favicon\.ico$/i',
            '/\.css$/i',
            '/\.js$/i',
            '/\.map$/i',
            '/\.jpg$/i',
            '/\.jpeg$/i',
            '/\.png$/i',
            '/\.gif$/i',
            '/\.svg$/i',
            '/\.webp$/i',
            '/\.woff2?$/i',
            '/\.ttf$/i',
            '/\.eot$/i',
            '/\/css\//i',
            '/\/js\//i',
            '/\/images\//i',
            '/\/fonts\//i',
            '/\/build\//i',
        ];

        foreach ($assetPatterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }

        return false;
    }
}
