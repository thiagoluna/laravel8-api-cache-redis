<?php

namespace App\Observers;

use App\Models\Module;
use Illuminate\Support\Str;

class ModuleObserver
{
    /**
     * Handle the Course "creating" event.
     *
     */
    public function creating(Module $nodule) : void
    {
        $nodule->uuid = (string) Str::uuid();
    }
}
