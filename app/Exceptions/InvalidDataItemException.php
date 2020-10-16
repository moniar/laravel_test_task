<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Blocks\ErrorCode;
use App\Exceptions\Blocks\ErrorSource;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class InvalidDataItemException
 * @package App\Exceptions\Validation
 */
abstract class InvalidDataItemException extends \Exception implements Arrayable
{
    use ErrorCode;
    use ErrorSource;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->getErrorCode(),
            'message' => $this->getMessage(),
            'source' => $this->getErrorSource(),
        ];
    }
}
