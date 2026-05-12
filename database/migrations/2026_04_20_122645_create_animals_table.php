<?php

use App\Models\Animal;
use App\Models\StatusAnimal;
use App\Models\User;
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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->integer('age');
            $table->text('picture');
            $table->text('description');
            $table->foreignIdFor(StatusAnimal::class)->constrained();
            $table->text('view');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
