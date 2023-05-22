<?php

declare(strict_types=1);

namespace MoonShine\Fields;

use Illuminate\Database\Eloquent\Model;
use MoonShine\Traits\Fields\NumberTrait;

class Number extends Text
{
    use NumberTrait;

    protected string $type = 'number';

    protected array $attributes = [
        'type',
        'min',
        'max',
        'step',
        'disabled',
        'readonly',
        'required',
    ];

    protected bool $stars = false;

    public function stars(): static
    {
        $this->stars = true;

        return $this;
    }

    public function withStars(): bool
    {
        return $this->stars;
    }

    public function indexViewValue(Model $item, bool $container = true): string
    {
        if ($this->withStars()) {
            return view('moonshine::ui.rating', [
                'value' => $item->{$this->field()},
            ])->render();
        }

        return parent::indexViewValue($item, $container);
    }

    public function exportViewValue(Model $item): string
    {
        return (string)$item->{$this->field()};
    }
}
