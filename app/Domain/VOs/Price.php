<?php

declare(strict_types=1);

namespace App\Domain\VOs;

use App\Exceptions\Validation\ValueInvalidException;

/**
 * Class Price
 * @package App\Domain\VOs
 */
class Price
{
    /**
     * Price value.
     * @var float
     */
    private float $value;

    /**
     * Price currency.
     * @var Currency
     */
    private Currency $currency;

    /**
     * Price constructor.
     * @param float $value
     * @param Currency $currency
     * @throws \App\Exceptions\InvalidDataItemException
     */
    public function __construct(float $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;

        $this->validate();
    }

    /**
     * Gets price value.
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Gets price currency.
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Validates if price is valid.
     * It cannot be < 0.
     * @throws \App\Exceptions\InvalidDataItemException
     */
    protected function validate(): void
    {
        if ($this->value < 0) {
            throw new ValueInvalidException('Price cannot be < 0.');
        }
    }
}
