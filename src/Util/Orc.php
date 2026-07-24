<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Console\Style\SymfonyStyle;

class Orc
{
    /** @var boolean */
    public bool $hasKey; // for opening the chest

    /**
     *@param bool $hasKey
     */
    public function __construct(bool $hasKey)
    {
       $this->hasKey = $hasKey;
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
}
