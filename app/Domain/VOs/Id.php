<?php

declare(strict_types=1);

namespace App\Domain\VOs;

/**
 * Class Id
 * @package App\Domain\VOs
 */
class Id
{
    /**
     * Identifier's value.
     * @var int
     */
    private int $value;

    /**
     * Id constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Gets identifier's value.
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
