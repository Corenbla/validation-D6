<?php

namespace classes\Status;

use classes\Character;

class Buff
{
    private $character;
    private $duration;

    public function __construct(Character $character, int $duration)
    {

        $this->character = $character;
        $this->duration = $duration;
    }

    public function decrementBuffDuration()
    {
        if ($this->duration > 0) {
            $this->duration--;
        }
    }

    public function isActive(): bool
    {
        return (bool) $this->duration;
    }
}
