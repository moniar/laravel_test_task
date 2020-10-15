<?php

declare(strict_types=1);

namespace App\Exceptions\Blocks;

/**
 * Trait ErrorSource
 * @package App\Exceptions\Blocks
 */
trait ErrorSource
{
    /**
     * Error source.
     * @var string
     */
    protected string $errorSource = '';

    /**
     * Sets error source.
     * @param string $errorSource
     * @return $this
     */
    public function setErrorSource(string $errorSource)
    {
        $this->errorSource = $errorSource;

        return $this;
    }

    /**
     * Gets error source.
     * @return string
     */
    public function getErrorSource(): string
    {
        return $this->errorSource;
    }
}
