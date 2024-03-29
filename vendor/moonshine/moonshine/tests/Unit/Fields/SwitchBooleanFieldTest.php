<?php

use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\SwitchBoolean;

uses()->group('fields');

beforeEach(function () {
    $this->field = SwitchBoolean::make('Active');
    $this->item = new class () extends Model {
        public bool $active = true;
    };
});

it('type', function () {
    expect($this->field->type())
        ->toBe('checkbox');
});

it('checkbox is parent', function () {
    expect($this->field)
        ->toBeInstanceOf(Checkbox::class);
});

it('view', function () {
    expect($this->field->getView())
        ->toBe('moonshine::fields.switch');
});

it('index view value with not auto update', function () {
    expect($this->field->autoUpdate(false)->indexViewValue($this->item))
        ->toBe(
            view('moonshine::ui.boolean', [
                'value' => $this->item->active,
            ])->render()
        );
});

it('index view value with auto update', function () {
    expect($this->field->indexViewValue($this->item))
        ->toBe(
            view('moonshine::fields.switch', [
                'element' => $this->field,
                'autoUpdate' => true,
                'item' => $this->item,
            ])->render()
        );
});
