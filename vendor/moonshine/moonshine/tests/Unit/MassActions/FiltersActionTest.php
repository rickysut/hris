<?php

use MoonShine\Actions\FiltersAction;
use MoonShine\Models\MoonshineUser;
use MoonShine\Tests\Fixtures\Resources\TestResourceBuilder;

uses()->group('mass-actions');

beforeEach(function () {
    $this->label = 'Filters';
    $this->resource = TestResourceBuilder::new(MoonshineUser::class, addRoutes: true);
    $this->action = FiltersAction::make($this->label)
        ->setResource($this->resource);
});

it('make new object', function () {
    expect($this->action)
        ->toBeInstanceOf(FiltersAction::class);
});

it('correct resource', function () {
    expect($this->action)
        ->resource()
        ->toBe($this->resource);
});

it('show in dropdown or line', function () {
    expect($this->action)
        ->showInLine()
        ->inDropdown()
        ->toBeFalse()
        ->showInDropdown()
        ->inDropdown()
        ->toBeTrue();
});

it('correct active count', function () {
    fakeRequest(
        $this->resource->route('index', query: [
            'filters' => [
                'name' => 'Value',
                'price' => [
                    'from' => 0,
                    'to' => 1000,
                ],
            ],
        ])
    );
    expect($this->action)
        ->activeCount()
        ->toBe(2);
});

it('render view', function () {
    test()->withViewErrors([]);

    expect($this->action)
        ->render()
        ->toContain($this->label);
});
