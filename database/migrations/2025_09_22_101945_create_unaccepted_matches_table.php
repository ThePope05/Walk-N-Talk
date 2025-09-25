<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unaccepted_matches', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'user_id_1');
            $table->foreignIdFor(User::class, 'user_id_2');
            $table->boolean('user_1_accepted')->default(false);
            $table->boolean('user_2_accepted')->default(false);
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
