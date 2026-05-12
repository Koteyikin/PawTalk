<?php

namespace App\Observers;

use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class AnimalObserver
{
    /**
     * Handle the Animal "created" event.
     */
    public function created(Animal $animal): void
    {
        DB::table('site_stats')->increment('animals_count');
    }

    /**
     * Handle the Animal "updated" event.
     */
    public function updated(Animal $animal): void
    {
        //
    }

    /**
     * Handle the Animal "deleted" event.
     */
    public function deleted(Animal $animal): void
    {
        //
    }

    /**
     * Handle the Animal "restored" event.
     */
    public function restored(Animal $animal): void
    {
        //
    }

    /**
     * Handle the Animal "force deleted" event.
     */
    public function forceDeleted(Animal $animal): void
    {
        //
    }
}
