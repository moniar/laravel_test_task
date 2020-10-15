<?php

declare(strict_types=1);

namespace App\Http\Tools\RequestDescription;

use Illuminate\Support\Collection;

/**
 * Class RequestKey
 * @package App\Http\Tools\RequestDescription
 */
class RequestKey
{
    const TYPE_STRING = 'string';
    const TYPE_NUMERIC = 'numeric';

    /**
     * Request key name.
     * @var string
     */
    private string $name;

    /**
     * Is request key required.
     * @var bool
     */
    private bool $required;

    /**
     * Request key value type.
     * @var string
     */
    private string $type;

    /**
     * RequestKey constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * Sets request key name.
     * @param string $name
     * @return $this
     */
    public function setName(string $name): RequestKey
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Sets that request key is required.
     * @return $this
     */
    public function setRequired(): RequestKey
    {
        $this->required = true;

        return $this;
    }

    /**
     * Sets that request key is optional.
     * @return $this
     */
    public function setOptional(): RequestKey
    {
        $this->required = false;

        return $this;
    }

    /**
     * Sets request key value type.
     * @param string $type
     * @return $this
     */
    public function setType(string $type): RequestKey
    {
        $this->validateType($type);

        $this->type = $type;

        return $this;
    }

    /**
     * Sets request key value type to string.
     * @return RequestKey
     */
    public function setTypeString(): RequestKey
    {
        return $this->setType(static::TYPE_STRING);
    }

    /**
     * Sets request key value type to numeric.
     * @return RequestKey
     */
    public function setTypeNumeric(): RequestKey
    {
        return $this->setType(static::TYPE_NUMERIC);
    }

    /**
     * Gets request key name.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Checks if request key is required.
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * Checks if request key is optional.
     * @return bool
     */
    public function isOptional(): bool
    {
        return $this->required;
    }

    /**
     * Gets request key value type.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Gets collection of allowed value types for request keys.
     * @return Collection
     */
    private function getAllowedTypes(): Collection
    {
        return collect(
            [
                self::TYPE_NUMERIC,
                self::TYPE_STRING
            ]
        );
    }

    /**
     * Checks if specified type is a valid request key value type.
     * @param string $type
     */
    private function validateType(string $type)
    {
        if (!$this->getAllowedTypes()->contains($type)) {
            throw new \InvalidArgumentException();
        }
    }
}
