<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('no_show_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reported_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reporter_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('reason')->nullable();
            $table->timestamps();

            // Een reporter kan een gebruiker max. 1x rapporteren
            $table->unique(['reported_user_id', 'reporter_user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('no_show_reports');
    }
};
