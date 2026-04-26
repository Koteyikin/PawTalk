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
        Schema::create('about_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname');
            $table->string('contact');
            $table->string('interests')->nullable();
            $table->text('city');
            $table->text('avatar');
            $table->text('description');
            $table->foreignIdFor(\App\Models\Status::class)->constrained();
            $table->foreignIdFor(\App\Models\Gender::class)->constrained();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_users');
    }
};
