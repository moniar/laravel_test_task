<?php

declare(strict_types=1);

namespace App\Http\Tools\RequestDescription;

use App\Exceptions\InvalidRequestBodyException;
use App\Exceptions\InvalidRequestContentTypeException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class RequestValidator
 * @package App\Http\Tools\RequestDescription
 */
class RequestValidator
{
    /**
     * Request to validate.
     * @var Request
     */
    private Request $request;

    /**
     * Request description that given request will be validated against.
     * @var RequestDescription
     */
    private RequestDescription $requestDescription;

    /**
     * RequestValidator constructor.
     * @param Request $request
     * @param RequestDescription $requestDescription
     */
    public function __construct(Request $request, RequestDescription $requestDescription)
    {
        $this->request = $request;
        $this->requestDescription = $requestDescription;
    }

    /**
     * Validates request.
     * @throws InvalidRequestBodyException
     * @throws InvalidRequestContentTypeException
     */
    public function validate(): void
    {
        $this->validateContentType();
        $this->validateKeys();
    }

    /**
     * Validates request content type.
     * @throws InvalidRequestContentTypeException
     */
    private function validateContentType(): void
    {
        $requestContentType = Str::of($this->request->headers->get('content-type'));
        $expectedContentType = $this->requestDescription->getContentType();

        if (!$requestContentType->exactly($expectedContentType)) {
            throw (new InvalidRequestContentTypeException(
                sprintf('Content-type %s is required.', $this->requestDescription->getContentType())
            ))->setExpectedContentType($expectedContentType);
        }
    }

    /**
     * Validate keys:
     * * if they are required/optional
     * * value types
     * * if there is no unexpected key
     * @throws InvalidRequestBodyException
     */
    private function validateKeys(): void
    {
        $expectedKeyNames = collect();

        /** @var RequestKey $requestKey */
        foreach ($this->requestDescription->getRequestKeys() as $requestKey) {
            $keyName = $requestKey->getName();
            $expectedKeyNames->add($keyName);

            try {
                $this->request->validate(
                    [
                        $keyName => $this->getRequestKeyRules($requestKey)
                    ]
                );
            } catch (ValidationException $e) {
                $message = collect($e->errors())->first()[0];
                throw (new InvalidRequestBodyException($message))->setErrorSource($keyName);
            }
        }

        $invalidKeys = collect($this->request->except($expectedKeyNames->all()));
        if ($invalidKeys->isNotEmpty()) {
            throw (new InvalidRequestBodyException('Invalid key found.'))
                ->setErrorSource($invalidKeys->first());
        }
    }

    /**
     * Gets rules expression for validator based on request key data.
     * @param RequestKey $requestKey
     * @return string
     */
    private function getRequestKeyRules(RequestKey $requestKey): string
    {
        return collect()
            ->add($requestKey->isRequired() ? 'required' : 'nullable')
            ->add($requestKey->getType())
            ->implode('|');
    }
}
