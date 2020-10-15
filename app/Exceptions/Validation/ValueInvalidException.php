<?php

declare(strict_types=1);

namespace App\Exceptions\Validation;

use App\Exceptions\InvalidDataItemException;

/**
 * Class ValueInvalidException
 * @package App\Exceptions\Validation
 */
class ValueInvalidException extends InvalidDataItemException
{
    /**
     * ValueInvalidException constructor.
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message ?: 'This value is invalid.', $code, $previous);

        $this->setErrorCode('invalid_value');
    }
}
