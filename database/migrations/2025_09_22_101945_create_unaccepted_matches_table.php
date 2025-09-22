<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unaccepted_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id_1');
            $table->foreignIdFor(User::class, 'user_id_2');
            $table->boolean('user_1_accepted');
            $table->boolean('user_2_accepted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unaccepted_matches');
    }
};
