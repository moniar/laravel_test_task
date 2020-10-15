<?php

declare(strict_types=1);

namespace App\Exceptions\Validation;

use App\Exceptions\InvalidDataItemException;

/**
 * Class ValueRequiredException
 * @package App\Exceptions\Validation
 */
class ValueRequiredException extends InvalidDataItemException
{
    /**
     * ValueRequiredException constructor.
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message ?: 'This value is required.', $code, $previous);

        $this->setErrorCode('invalid_value_required');
    }
}
