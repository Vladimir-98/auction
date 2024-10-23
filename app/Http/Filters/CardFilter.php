<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class ProductFilter
 */
class CardFilter extends Filter
{
    /**
     * @param array $value
     * @return Builder
     */
    protected function categories(array $value): Builder
    {
        return $this->builder->whereHas('types', function ($q) use ($value) {
            $q->whereIn('type_id', $value);
        });
    }

    /**
     * @param array $value
     * @return Builder
     */
    protected function districts(array $value): Builder
    {
        return $this->builder->whereHas('districts', function ($q) use ($value) {
            $q->whereIn('district_id', $value);
        });
    }

    /**
     * @param array $value
     * @return Builder
     */
    protected function paymentType(array $value): Builder
    {
        return $this->builder->whereHas('payment_types', function ($q) use ($value) {
            $q->whereIn('payment_type_id', $value);
        });
    }

    /**
     * @param array $value
     * @return Builder
     */
    protected function leadPrice(array $value): Builder
    {
        $min = (int)str_replace(' ', '', $value['min'] ?? 0);
        $max = (int)str_replace(' ', '', $value['max'] ?? 0);

        if ($min && $max) {
            $this->builder->whereBetween('lead_price', [$min, $max]);
        } elseif ($min) {
            $this->builder->where('lead_price', '>=', $min);
        } elseif ($max) {
            $this->builder->where('lead_price', '<=', $max);
        }

        return $this->builder;
    }

    /**
     * @param array $value
     * @return Builder
     */
    protected function budget(array $value): Builder
    {
        $min = (int)str_replace(' ', '', $value['min'] ?? 0);
        $max = (int)str_replace(' ', '', $value['max'] ?? 0);

        return $this->builder->where(function ($query) use ($min, $max) {

            if ($min && $max) {
                $query->whereBetween('budget_min', [$min, $max])
                    ->orWhereBetween('budget_max', [$min, $max])
                    ->orWhere(function ($q) use ($min, $max) {
                        $q->where('budget_min', '<=', $min)
                            ->where('budget_max', '>=', $max);
                    });
            } elseif ($min) {
                $query->where('budget_min', '>=', $min)
                    ->orWhere('budget_max', '>=', $min);
            } elseif ($max) {
                $query->where('budget_max', '<=', $max)
                    ->orWhere('budget_min', '<=', $max);
            }

            $query->orWhere(function ($q) {
                $q->whereNull('budget_min')
                    ->whereNull('budget_max');
            });
        });

    }

    /**
     * @return Builder
     */
    protected function typeVisibility(): Builder
    {
        return $this->builder->whereHas('types', function ($q) {
            $q->where('visibility', true);
        });
    }

    /**
     * @return Builder
     */
    protected function statusVisibility(): Builder
    {
        return $this->builder->whereHas('status', function ($q) {
            $q->where('visibility', true);
        });
    }

}
