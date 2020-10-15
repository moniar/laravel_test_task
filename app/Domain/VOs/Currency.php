<?php

declare(strict_types=1);

namespace App\Domain\VOs;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Class Currency
 * @package App\Domain\VOs
 */
class Currency extends Stringable
{
    public const DEFAULT = self::PLN;

    public const PLN = 'PLN';
    public const EUR = 'EUR';
    public const USD = 'USD';

    /**
     * Currency constructor.
     * @param string $isoCode
     */
    public function __construct(string $isoCode)
    {
        parent::__construct(Str::of($isoCode)->trim()->upper());
    }

    /**
     * Gets default currency.
     * @return Currency
     */
    public static function getDefaultCurrency(): Currency
    {
        return new self(static::DEFAULT);
    }
}
