<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TemplateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProvisionController extends Controller
{
    public function createUser(Request $request)
    {
        // Token verificatie
        if ($request->header('X-Provision-Token') !== config('app.provision_token')) {
            Log::warning('Invalid provision token attempt', [
                'ip' => $request->ip(),
                'email' => $request->email,
            ]);
            abort(403, 'Invalid provision token');
        }

        // Validatie
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|string', // Al gehashed, geen min length
            ]);
        } catch (ValidationException $e) {
            Log::error('Provision user validation failed', [
                'errors' => $e->errors(),
            ]);
            throw $e;
        }

        // User aanmaken/updaten
        try {
            $user = User::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'password' => $validated['password'],
                ]
            );

            // Assign customer role if not already assigned
            if (! $user->hasRole('customer')) {
                $user->assignRole('customer');
            }

            Log::info('User provisioned successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => 'customer',
            ]);

            return response()->json([
                'success' => true,
                'user_id' => $user->id,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to provision user', [
                'email' => $validated['email'],
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create user',
            ], 500);
        }
    }

    public function setTemplate(Request $request)
    {
        // Token verificatie (zelfde methode als createUser)
        if ($request->header('X-Provision-Token') !== config('app.provision_token')) {
            Log::warning('Invalid provision token for template sync', [
                'ip' => $request->ip(),
            ]);
            abort(403, 'Invalid provision token');
        }

        // Validatie
        $validated = $request->validate([
            'template_slug' => 'required|string|max:255',
            'template_config' => 'nullable|array',
        ]);

        try {
            // Check of template view folder bestaat
            $templatePath = resource_path("views/components/templates/{$validated['template_slug']}");
            if (! is_dir($templatePath)) {
                Log::warning('Template folder not found', [
                    'template_slug' => $validated['template_slug'],
                    'path' => $templatePath,
                ]);
                // Niet blokkeren - fallback views worden gebruikt
            }

            // Template slug opslaan
            DB::table('settings')->updateOrInsert(
                ['group' => 'site', 'name' => 'template_slug'],
                [
                    'locked' => false,
                    'payload' => json_encode($validated['template_slug']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Template config opslaan
            if (! empty($validated['template_config'])) {
                DB::table('settings')->updateOrInsert(
                    ['group' => 'site', 'name' => 'template_config'],
                    [
                        'locked' => false,
                        'payload' => json_encode($validated['template_config']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            // Clear template cache so the new template is loaded
            app(TemplateService::class)->clearCache();

            // Also clear the settings cache
            cache()->forget('spatie.laravel-settings.settings');

            Log::info('Template provisioned successfully', [
                'template_slug' => $validated['template_slug'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Template configuration saved',
                'template_slug' => $validated['template_slug'],
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to provision template', [
                'error' => $e->getMessage(),
                'template_slug' => $validated['template_slug'] ?? null,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save template configuration',
            ], 500);
        }
    }
}
