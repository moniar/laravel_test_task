<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource
 * @package App\Http\Resources
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'id' => $this->getId(),
           'name' => (string)$this->getName(),
           'price' => $this->getPrice()->getValue(),
           'currency' => (string)$this->getPrice()->getCurrency()
       ];
    }
}
