<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\InvalidDataItemException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class InvalidDataBagException
 * @package App\Exceptions
 */
class InvalidDataBagException extends \Exception implements Arrayable
{
    /**
     * Collection of entity errors.
     * @var Collection
     */
    private Collection $errors;

    /**
     * InvalidDataBagException constructor.
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = collect();
    }

    /**
     * Adds entity error exception.
     * @param InvalidDataItemException $errorException
     * @return $this
     */
    public function addError(InvalidDataItemException $errorException): InvalidDataBagException
    {
        $this->errors->add($errorException);
        return $this;
    }

    /**
     * Checks if exception is not empty (if there is no specific entity error exceptions inside).
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->errors->isEmpty();
    }

    /**
     * Throws if exception has at least one entity error exception inside.
     * @throws InvalidDataBagException
     */
    public function throwIfNotEmpty()
    {
        if ($this->isNotEmpty()) {
            throw $this;
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->errors->toArray();
    }
}
