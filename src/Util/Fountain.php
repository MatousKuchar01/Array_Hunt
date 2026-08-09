<?php

declare(strict_types=1);

namespace App\Util;

use App\Enum\AppEnum;
use App\Enum\Loot;
use App\Util\Knight;
use App\Generator\LootGenerator;
use Symfony\Component\Console\Style\SymfonyStyle;

class Fountain
{
    /** @var bool */
    public $isUsed = false;

    public function __construct() {}

    /**
     * @return string
     */
    public function getFountain(): string
    {
        return '<<FOUNTAIN>>';
    }

    /**
     * @return string
     */
    public function getUsedFountain(): string
    {
        return '<<FOUNTAIN>>[DRY]';
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->isUsed() ? $this->getUsedFountain() : $this->getFountain();
    }

    /**
     * is fountain used
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->isUsed;
    }

    /**
     * fountain was used
     * @return void
     */
    public function markAsUsed(): void
    {
        $this->isUsed = true;
    }

    /**
     * @param mixed $target
     * @return bool
     */
    public static function isTargetFountain(mixed $target): bool
    {
    	if ($target instanceof self) {
    		return true;
    	} else {
    		return false;
    	}
    }
}
