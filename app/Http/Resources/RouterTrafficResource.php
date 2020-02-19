<?php

namespace App\Http\Resources;

use App\Helpers\Formatter;
use Illuminate\Http\Resources\Json\JsonResource;

class RouterTrafficResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        self::withoutWrapping();
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return collect($this->resource)->mapWithKeys(function ($value, $key) {
            return [ Formatter::cleanKey($key) => $value ];
        })->toArray();
    }
}
