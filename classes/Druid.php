<?php

namespace classes;

class Druid extends Character
{
    private $buffs = [];

    public function attack(Character $target)
    {
        $this->decrementBuffsDuration();
        $rand = rand(1, 10);

        if ($rand === 1 && $this->lifePoints < self::MAX_LIFEPOINTS) {
            $this->castHeal();
            $status = "$this->name appelle la sagesse des anciens pour se soigner complètement !";
        } elseif ($rand <= 4 && !isset($this->buffs['natureStrength'])) {
            $this->castNatureStrength();
            $status = "$this->name appelle les forces de la nature pour augmenter ses dégats !";
        } else {
            $attack = $this->staffStrike($target);
            $status = "$this->name attaque $target->name avec son baton et lui inflige $attack dégats !";
        }

        return $status;
    }

    private function castHeal()
    {
        $this->lifePoints = self::MAX_LIFEPOINTS;
    }

    private function castNatureStrength()
    {
        $this->buffs['natureStrength']['duration'] = 3;
    }

    private function staffStrike(Character $target): int
    {
        $attack = rand(5, 15);
        if (isset($this->buffs['natureStrength'])) {
            $attack *= 1.5;
        }

        $target->setLifePoints($attack);

        return $attack;
    }

    private function decrementBuffsDuration()
    {
        foreach ($this->buffs as $buff) {
            if ($buff['duration'] > 0) {
                $buff['duration']--;
            } else {
                unset($buff); // Remove the buff from the list
            }
        }
    }
}