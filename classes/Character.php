<?php

namespace classes;

abstract class Character
{
    const MAX_LIFEPOINTS = 100;

    protected $lifePoints = self::MAX_LIFEPOINTS;
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

    abstract public function attack(Character $target);
}
