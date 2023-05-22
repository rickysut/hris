<?php

declare(strict_types=1);

namespace MoonShine\Filters;

use MoonShine\Traits\Fields\BooleanTrait;

class SwitchBooleanFilter extends Filter
{
    use BooleanTrait;

    public string $type = 'checkbox';

    protected static string $view = 'moonshine::filters.switch';
}
