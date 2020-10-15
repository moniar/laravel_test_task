<?php

declare(strict_types=1);

namespace App\Http\Tools\RequestDescription;

use Illuminate\Support\Collection;

/**
 * Class RequestDescription
 * @package App\Http\Tools\RequestDescription
 */
class RequestDescription
{
    /**
     * Expected content-type.
     * @var string
     */
    private string $contentType = 'application/json';

    /**
     * Collection of request key objects.
     * @var Collection
     */
    private Collection $requestKeys;

    /**
     * RequestDescription constructor.
     */
    public function __construct()
    {
        $this->requestKeys = collect();
    }

    /**
     * Sets expected content type.
     * @param string $contentType
     * @return $this
     */
    public function setContentType(string $contentType): RequestDescription
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Adds request key object.
     * @param RequestKey $requestKey
     * @return $this
     */
    public function addRequestKey(RequestKey $requestKey): RequestDescription
    {
        $this->requestKeys->add($requestKey);

        return $this;
    }

    /**
     * Gets expected content-type.
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * Gets collection of request key objects.
     * @return Collection
     */
    public function getRequestKeys(): Collection
    {
        return $this->requestKeys;
    }
}
