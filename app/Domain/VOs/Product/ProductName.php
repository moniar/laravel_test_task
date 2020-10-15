<?php

declare(strict_types=1);

namespace App\Domain\VOs\Product;

use App\Exceptions\Validation\ValueInvalidException;
use App\Exceptions\Validation\ValueRequiredException;
use App\Domain\VOs\Name;

/**
 * Class ProductName
 * @package App\Domain\VOs\Product
 */
class ProductName extends Name
{
    const MAX_LENGTH = 255;

    /**
     * ProductName constructor.
     * @param string $name
     * @throws \App\Exceptions\InvalidDataItemException
     */
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->validate();
    }

    /**
     * Validates if product name is valid.
     * It cannot be empty and cannot be longer than 255.
     * @throws \App\Exceptions\InvalidDataItemException
     */
    private function validate(): void
    {
        if ($this->isEmpty()) {
            throw ValueRequiredException::createWithMessage('Product name cannot be empty.');
        }

        if ($this->length() > self::MAX_LENGTH) {
            throw ValueInvalidException::createWithMessage(
                sprintf('Product name cannot be longer than %s chars.', self::MAX_LENGTH)
            );
        }
    }
}
