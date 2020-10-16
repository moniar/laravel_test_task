<?php

declare(strict_types=1);

namespace App\Domain\VOs\Product;

use App\Exceptions\Validation\ValueInvalidException;
use App\Domain\VOs\Currency;
use App\Domain\VOs\Price;

/**
 * Class ProductPrice
 * @package App\Domain\VOs\Product
 */
class ProductPrice extends Price
{
    /**
     * Allowed currencies for product.
     * @var array
     */
    protected $allowedCurrencies = [
        Currency::PLN,
        Currency::EUR,
        Currency::USD
    ];

    /**
     * Validates if product price is valid.
     * It has to be a valid price + currency has to be one of the allowed.
     * @throws \App\Exceptions\InvalidDataItemException
     */
    protected function validate(): void
    {
        parent::validate();

        $allowedCurrenciesCollection = collect($this->allowedCurrencies);
        if (!$allowedCurrenciesCollection->contains((string)$this->getCurrency())) {
            throw new ValueInvalidException(
                sprintf(
                    'Product price can be defined only in following currencies: %s.',
                    $allowedCurrenciesCollection->implode(', ')
                )
            );
        }
    }
}
