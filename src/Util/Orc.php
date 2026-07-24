<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Console\Style\SymfonyStyle;

class Orc
{
    /**
     * @return string
     */
    public function getIcon(): string
    {
        return '<ORC>'; // :OOOO
    }
}
