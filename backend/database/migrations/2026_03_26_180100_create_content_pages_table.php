<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('content_section_id')->nullable()->constrained('content_sections')->nullOnDelete();
            $table->string('source_path')->unique();
            $table->string('title')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->string('meta_keywords', 1000)->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('is_homepage')->default(false);
            $table->longText('html');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
