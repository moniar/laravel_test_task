<?php

declare(strict_types=1);

namespace App\Exceptions\Blocks;

/**
 * Trait ErrorCode
 * @package App\Exceptions\Blocks
 */
trait ErrorCode
{
    /**
     * Error code.
     * @var string
     */
    protected string $errorCode;

    /**
     * Sets error code.
     * @param string $errorCode
     * @return $this
     */
    public function setErrorCode(string $errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Gets error code.
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
