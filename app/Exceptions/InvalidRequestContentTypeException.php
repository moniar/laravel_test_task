<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Blocks\ErrorCode;
use Illuminate\Contracts\Support\Arrayable;
use Throwable;

/**
 * Class InvalidRequestContentTypeException
 * @package App\Exceptions
 */
class InvalidRequestContentTypeException extends \Exception implements Arrayable
{
    use ErrorCode;

    /**
     * Expected content type.
     * @var string
     */
    private string $expectedContentType;

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
     * Sets expected content type.
     * @param string $expectedContentType
     * @return $this
     */
    public function setExpectedContentType(string $expectedContentType): InvalidRequestContentTypeException
    {
        $this->expectedContentType = $expectedContentType;

        return $this;
    }

    /**
     * Gets expected content type.
     * @return string
     */
    public function getExpectedContentType(): string
    {
        return $this->expectedContentType;
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
