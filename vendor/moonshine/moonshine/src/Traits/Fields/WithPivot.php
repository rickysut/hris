<?php

declare(strict_types=1);

namespace MoonShine\Traits\Fields;

use Illuminate\Database\Eloquent\Model;

trait WithPivot
{
    public function getPivotAs(Model $item): int|string|null
    {
        return array_key_first($item->getRelations());
    }

    public function pivotItem(Model $item, $id): ?Model
    {
        $value = $this->formViewValue($item);

        return $value->isNotEmpty()
            ? $value->firstWhere($value->first()->getKeyName(), '=', $id)
            : null;
    }

    public function pivotValue(Model $item, $id): Model
    {
        $pivotItem = $this->pivotItem($item, $id);

        return $pivotItem
            ? $pivotItem->{$this->getPivotAs($pivotItem)}
            : $item->newInstance();
    }
}
