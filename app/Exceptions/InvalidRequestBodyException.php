<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Blocks\ErrorCode;
use App\Exceptions\Blocks\ErrorSource;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class InvalidRequestBodyException
 * @package App\Exceptions
 */
class InvalidRequestBodyException extends \Exception implements Arrayable
{
    use ErrorCode;
    use ErrorSource;

    /**
     * InvalidRequestBodyException constructor.
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setErrorCode('invalid_request_body');
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
            'message' => $this->getMessage(),
            'source' => $this->getErrorSource()
        ];
    }
}
