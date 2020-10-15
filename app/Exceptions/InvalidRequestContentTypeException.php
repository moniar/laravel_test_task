<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Blocks\ErrorCode;
use Throwable;

/**
 * Class InvalidRequestContentTypeException
 * @package App\Exceptions
 */
class InvalidRequestContentTypeException extends \Exception
{
    use ErrorCode;

    /**
     * InvalidRequestContentTypeException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setErrorCode('invalid_request_content_type');
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
            'message' => $this->getMessage()
        ];
    }
}
