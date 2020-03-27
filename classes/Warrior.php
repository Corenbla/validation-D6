<?php

namespace classes;

class Warrior extends Character
{
    private $boost = false;

    public function attack(Character $target)
    {
        $rand = rand(1, 10);
        if ($rand <= 8 || $this->boost) {
            return $this->sword($target);
        } else {
            return $this->boost();
        }
    }

    private function sword(Character $target)
    {
        $attack = rand(5, 15);
        if ($this->boost) {
            $rand = rand(17, 30);
            $rand /= 10;
            $attack *= $rand;
            $this->boost = false;
        }
        $target->setlifePoints($attack);

        return "$this->name attaque {$target->name}! Il reste {$target->getLifePoints()} à {$target->name} !";
    }

    private function boost()
    {
        $this->boost = true;

        return "{$this->name} se concentre pour taper plus fort!";
    }
}
