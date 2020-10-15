<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Blocks\ErrorCode;
use App\Exceptions\Blocks\ErrorSource;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class InvalidDataItemException
 * @package App\Exceptions\Validation
 */
abstract class InvalidDataItemException extends \Exception implements Arrayable
{
    use ErrorCode;
    use ErrorSource;

    /**
     * Creates new invalid entity error exception with specified message.
     * @param string $message
     * @return InvalidDataItemException
     */
    public static function createWithMessage(string $message): InvalidDataItemException
    {
        return new static($message);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->getErrorCode(),
            'source' => $this->getErrorSource(),
            'message' => $this->getMessage()
        ];
    }
}
