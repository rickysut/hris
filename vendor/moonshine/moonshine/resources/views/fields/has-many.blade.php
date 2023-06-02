@if($element->isResourceMode())
    @if($item->exists)
        <x-moonshine::title class="mb-6">
            {{ $element->label() }}
        </x-moonshine::title>

        <x-moonshine::async-modal
            id="create_{{ $element->resource()->getModel()->getTable() }}_modal_{{ $element->id() }}"
            route="{{ $resource->route('relation-field-form', query: [
            '_field_relation' => $element->relation(),
            '_related_key' => $item->getKey()
            ]) }}"
            title="{{ $element->resource()->title() }}"
        >
            <x-moonshine::icon
                icon="heroicons.squares-plus"
                size="4"
            />
            <span>{{ trans('moonshine::ui.create') }}</span>
        </x-moonshine::async-modal>

        <hr class="divider" />

        <div x-data="asyncData"
             x-init="load(
                '{{ $resource->route('relation-field-items', $item->getKey(), query: [
                        '_field_relation' => $element->relation()
                    ]) }}',
                 'has_many_{{ $element->id() }}'
             )">
            <div id="has_many_{{ $element->id() }}"></div>
        </div>
    @endif
@else
    @include('moonshine::fields.table-fields', [
        'element' => $element,
        'resource' => $resource,
        'item' => $item,
        'model' => $element->formViewValue($item)->first() ?? $element->getRelated($item),
        'level' => $level ?? 0,
        'toOne' => false,
    ])
@endif
