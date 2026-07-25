<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Console\Style\SymfonyStyle;

class Orc
{
    /** hitboxes on orcs body */
    public const HITBOX_TOP = 'TOP';
    public const HITBOX_LEFT = 'LEFT';
    public const HITBOX_RIGHT = 'RIGHT';
    public const HITBOX_B_LEFT = 'B_LEFT';
    public const HITBOX_B_RIGHT = 'B_RIGHT';
    public const HITBOX_STAB = 'STAB';

    public const HITBOXES = [
        self::HITBOX_TOP, self::HITBOX_LEFT, self::HITBOX_RIGHT,
        self::HITBOX_B_LEFT, self::HITBOX_B_RIGHT, self::HITBOX_STAB
    ];

    /** @var array */
    public array $blockedHitboxes = []; // hitboxes which is orc covering
    /** @var boolean */
    public bool $hasKey; // for opening the chest

    /**
     *@param bool $hasKey
     */
    public function __construct(bool $hasKey)
    {
       $this->hasKey = $hasKey;
       $this->generateStance();
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '<ORC>'; // :OOOO
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getIcon();
    }

    /**
     * decides what hitboxes will orc have blocked
     * @return void
     */
    public function generateStance(): void
    {
        $hitboxes = self::HITBOXES;
        shuffle($hitboxes);
        $numberOfBlocked = 3;

        $this->blockedHitboxes = array_slice($hitboxes, 0, $numberOfBlocked);

    }

    /**
     * @param string $hitbox
     * @return bool
     */
    public function isHitboxBlocked(string $hitbox): bool
    {
        return in_array($hitbox, $this->blockedHitboxes);
    }

    /**
     * @return bool
     */
    public function hasKey(): bool
    {
        return $this->hasKey === true;
    }

    /**
     * @param mixed $target
     * @return bool
     */
    public static function isTargetOrc(mixed $target): bool
    {
    	if ($target instanceof self) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
