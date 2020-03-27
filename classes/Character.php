<?php

namespace classes;

use classes\Status\Buff;

abstract class Character
{
    const MAX_LIFEPOINTS = 100;

    /**
     * @var Buff[]
     */
    private $buffs = [];
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

    protected function addBuff(string $key, Buff $buff)
    {
        $this->buffs[$key] = $buff;
    }

    protected function decrementAllBuffsDuration()
    {
        foreach ($this->buffs as $key => $buff) {
            $buff->decrementBuffDuration();
            if (!$buff->isActive()) {
                unset($this->buffs[$key]);
            }
        }
    }

    protected function decrementBuffDuration(string $key)
    {
        $this->buffs[$key]->decrementBuffDuration();
        if (!$this->buffs[$key]->isActive()) {
            unset($this->buffs[$key]);
        }
    }

    protected function hasActiveBuff(string $key): bool
    {
        return isset($this->buffs[$key]);
    }

    abstract public function attack(Character $target);
}
