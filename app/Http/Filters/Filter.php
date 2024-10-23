<?php

namespace App\Http\Filters;

use Carbon\CarbonImmutable;
use http\Env\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Filter
 */
abstract class Filter
{
    public const KEYS_TO_BOOL = [];
    public const KEYS_TO_INT = [];
    public const KEYS_TO_DATE = [];
    public const KEYS_STRING_TO_ARRAY = [];
    public const KEYS_TO_ARRAY = [];

    protected Builder $builder;

    /**
     * Filter constructor.
     * @param FormRequest $request
     */
    public function __construct(protected FormRequest $request)
    {
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        $this->builder = $this->statusVisibility();
        $this->builder = $this->typeVisibility();

        foreach ($this->request->get('filter', []) as $method => $value) {
            $methodName = Str::camel($method);

            if (null === $value) {
                continue;
            }

            if (method_exists($this, $methodName)) {
                if (in_array($method, static::KEYS_TO_BOOL, true)) {
                    $value = (bool)$value;
                }

                if (in_array($method, static::KEYS_TO_INT, true)) {
                    $value = (int)$value;
                }

                if (in_array($method, static::KEYS_TO_DATE, true)) {
                    $value = CarbonImmutable::parse($value);
                }

                if (in_array($method, static::KEYS_TO_ARRAY, true)) {
                    $value = is_array($value) ? $value : [$value];
                }

                if (in_array($method, static::KEYS_STRING_TO_ARRAY, true)) {
                    $value = explode(',', $value);
                }

                $this->builder = $this->{$methodName}($value);
            }
        }

        return $this->builder;
    }
}
