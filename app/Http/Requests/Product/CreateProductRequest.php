<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use App\Http\Tools\RequestDescription\RequestDescription;
use App\Http\Tools\RequestDescription\RequestKey;

/**
 * Class CreateProductRequest
 * @package App\Http\Requests\Product
 */
class CreateProductRequest extends RequestDescription
{
    /**
     * CreateProductRequest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->addRequestKey(
            (new RequestKey('name'))
                ->setRequired()
                ->setTypeString()
        );

        $this->addRequestKey(
            (new RequestKey('price'))
                ->setRequired()
                ->setTypeNumeric()
        );
    }
}
