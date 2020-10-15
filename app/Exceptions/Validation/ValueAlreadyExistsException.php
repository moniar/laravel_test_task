<?php

declare(strict_types=1);

namespace App\Exceptions\Validation;

use App\Exceptions\InvalidDataItemException;
use Throwable;

/**
 * Class ValueAlreadyExistsException
 * @package App\Exceptions\Validation
 */
class ValueAlreadyExistsException extends InvalidDataItemException
{
    /**
     * ValueAlreadyExistsException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'This value already exists.', $code, $previous);

        $this->setErrorCode('invalid_value_unique');
    }
}
