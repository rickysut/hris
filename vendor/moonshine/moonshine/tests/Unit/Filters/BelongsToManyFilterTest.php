<?php

use MoonShine\Filters\BelongsToManyFilter;
use MoonShine\Filters\SelectFilter;

uses()->group('filters');
uses()->group('relation-filters');

beforeEach(function () {
    $this->filter = BelongsToManyFilter::make('Belongs to many');
});

it('select filter is parent', function () {
    expect($this->filter)
        ->toBeInstanceOf(SelectFilter::class);
});
