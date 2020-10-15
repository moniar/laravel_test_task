<?php

declare(strict_types=1);

namespace App\Domain\VOs;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Class Name
 * @package App\Domain\VOs
 */
class Name extends Stringable
{
    /**
     * Name constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct(Str::of($name)->trim());
    }
}
