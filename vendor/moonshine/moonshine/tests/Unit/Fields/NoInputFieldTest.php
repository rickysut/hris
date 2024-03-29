<?php

use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\NoInput;

uses()->group('fields');

beforeEach(function () {
    $this->field = NoInput::make('NoInput', 'no_input');
    $this->item = new class () extends Model {
        public string|bool $no_input = 'Hello world';
    };
});

it('view', function () {
    expect($this->field->getView())
        ->toBe('moonshine::fields.no-input');
});

it('default item value', function () {
    expect($this->field->indexViewValue($this->item))
        ->toBe($this->item->no_input);
});

it('reformat item value', function () {
    $this->field = NoInput::make('NoInput', 'no_input', fn () => 'Testing');

    expect($this->field->indexViewValue($this->item))
        ->toBe('Testing');
});

it('badge value', function () {
    expect($this->field->badge('green')->indexViewValue($this->item))
        ->toBe(view('moonshine::ui.badge', [
            'color' => 'green',
            'value' => $this->item->no_input,
        ])->render());
});

it('boolean value', function () {
    $this->item->no_input = true;

    expect($this->field->boolean()->indexViewValue($this->item))
        ->toBe(view('moonshine::ui.boolean', [
            'value' => $this->item->no_input,
        ])->render())
    ->and($this->field->boolean(hideTrue: true)->indexViewValue($this->item))
        ->toBeEmpty();

    $this->item->no_input = false;

    expect($this->field->boolean(hideFalse: true)->indexViewValue($this->item))
        ->toBeEmpty();
});

it('link value', function () {
    expect($this->field->link('/', true)->indexViewValue($this->item))
        ->toBe(view('moonshine::ui.url', [
            'value' => $this->item->no_input,
            'href' => '/',
            'blank' => true,
        ])->render());
});
