<?php

namespace classes;

use classes\Status\Buff;

class Warrior extends Character
{
    public function attack(Character $target)
    {
        $rand = rand(1, 10);
        if ($rand <= 8 || $this->hasActiveBuff('boost')) {
            return $this->sword($target);
        } else {
            return $this->boost();
        }
    }

    private function sword(Character $target)
    {
        $attack = rand(5, 15);
        if ($this->hasActiveBuff('boost')) {
            $rand = rand(17, 30);
            $rand /= 10;
            $attack *= $rand;
            $this->decrementBuffDuration('boost');
        }
        $target->setlifePoints($attack);

        return "$this->name attaque {$target->name}! Il reste {$target->getLifePoints()} à {$target->name} !";
    }

    private function boost()
    {
        $this->addBuff('boost', new Buff($this, 1));

        return "{$this->name} se concentre pour taper plus fort!";
    }
}
