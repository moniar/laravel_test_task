<?php

declare(strict_types=1);

namespace App\Domain\VOs;

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
     */
    public function __construct(float $value, Currency  $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
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
}
