<?php

namespace classes;

class Character
{
    protected $lifePoints = 100;
    public static $pv = 350;
    public $name;
    public $magicPoints = 10;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getLifePoints()
    {
        return $this->lifePoints;
    }

    public function setLifePoints(float $dmg)
    {
        $this->lifePoints -= round($dmg);
        if ($this->lifePoints < 0) {
            $this->lifePoints = 0;
        }

        return;
    }
}