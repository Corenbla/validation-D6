<?php

namespace classes;

use classes\Status\Buff;

class Mage extends Character
{
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->magicPoints *= 7;
    }

    public function attack(Character $target)
    {
        $rand = rand(1, 2);
        if ($rand == 1 || $this->hasActiveBuff('shield')) {
            $status = $this->fireball($target);
        } else {
            $status = $this->shield();
        }

        return $status;
    }

    private function fireball(Character $target)
    {
        $rand = rand(5, 10);

        if ($rand <= $this->magicPoints) {
            $atk = $rand * 1.5;
            $this->magicPoints -= $rand;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance une boule de feu à {$target->name}! Il reste {$target->getLifePoints()} à {$target->name} !";
        } elseif ($this->magicPoints > 0) {
            $atk = $this->magicPoints * 1.5;
            $this->magicPoints = 0;
            $target->setLifePoints($atk);
            $status = "{$this->name} lance une boule de feu à {$target->name}! Il reste {$target->getLifePoints()} à {$target->name} !";
        } else {
            $target->setLifePoints(2);
            $status = "{$this->name} n'a plus de point de magie, et attaque {$target->name} au couteau (ahah)! Il reste {$target->getLifePoints()} à {$target->name} !";
        }

        return $status;
    }

    private function shield()
    {
        $this->addBuff('shield', new Buff($this, 1));

        return "{$this->name} lance un bouclier magique pour se protéger!";
    }

    public function setLifePoints($dmg)
    {
        if ($this->hasActiveBuff('shield')) {
            $this->decrementBuffDuration('shield');
            return;
        }

        parent::setLifePoints($dmg);
    }
}