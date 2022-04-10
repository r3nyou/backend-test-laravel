<?php

namespace App\Events;

use Illuminate\Support\Str;

abstract class Event
{
    abstract public function locale(): string;

    abstract public function payload(): array;

    public function langFile(): string
    {
        $name = Str::lower(Str::remove(
            'App\Events\\',
            get_class($this)
        ));

        return Str::replace('\\', '/', $name);
    }
}
