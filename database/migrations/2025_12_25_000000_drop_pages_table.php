<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop foreign key constraint first (if exists)
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                if (Schema::hasColumn('pages', 'parent_id')) {
                    $table->dropForeign(['parent_id']);
                }
            });

            // Then drop the table
            Schema::dropIfExists('pages');
        }
    }

    public function down(): void
    {
        // Recreate structure for rollback
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug');
            $table->string('layout')->index();
            $table->json('blocks')->nullable();
            $table->foreignId('parent_id')->nullable()
                ->constrained('pages')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();

            $table->unique(['slug', 'parent_id']);
        });
    }
};
