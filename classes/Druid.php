<?php

namespace classes;

use classes\Status\Buff;

class Druid extends Character
{
    public function attack(Character $target)
    {
        $rand = rand(1, 10);

        if ($rand === 1 && $this->lifePoints < self::MAX_LIFEPOINTS) {
            $this->castHeal();
            $status = "$this->name appelle la sagesse des anciens pour se soigner complètement !";
        } elseif ($rand <= 4 && !$this->hasActiveBuff('natureStrength')) {
            $this->castNatureStrength();
            $status = "$this->name appelle les forces de la nature pour augmenter ses dégats !";
        } else {
            $this->staffStrike($target);
            $status = "$this->name attaque $target->name avec son baton ! il reste {$target->getLifePoints()} à $target->name";
        }

        if ($this->hasActiveBuff('natureStrength')) {
            $this->decrementBuffDuration('natureStrength');
        }
        return $status;
    }

    private function castHeal()
    {
        $this->lifePoints = self::MAX_LIFEPOINTS;
    }

    private function castNatureStrength()
    {
        $this->addBuff('natureStrength', new Buff($this, 3));
    }

    private function staffStrike(Character $target)
    {
        $attack = rand(5, 15);
        if ($this->hasActiveBuff('natureStrength')) {
            $attack *= 1.5;
        }

        $target->setLifePoints($attack);
    }
}