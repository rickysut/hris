
<x-moonshine::box
        title="#{{ $item->getKey() }}"
>
    <x-moonshine::table>
        <x-slot:tbody>
            @foreach($resource->getFields()->detailFields() as $index => $field)
                <tr>
                    <th width="15%">
                        {{$field->label()}}
                    </th>
                    <td>{!! $field->isSee($item) ? $field->indexViewValue($item): '' !!}</td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-moonshine::table>



    @php $resources = $item->attendance; @endphp

        <div x-data="crudTable('true')">
            <x-moonshine::loader x-show="loading" />
            <div x-show="!loading">
                @if($resources->isNotEmpty())
                    {{ dd($resources) }}
                    <x-moonshine::table
                        :crudMode="true"
                    >
                        <x-slot:thead>
                            {{-- @include("crud.table-head-karyawan", [$resource]) --}}
                            @foreach($resources as $field)

                                <th>
                                    <div class="flex items-baseline gap-x-1">
                                        {{ $field->tanggal }}

                                        @if(!$resource->isPreviewMode() && $field->isSortable())
                                            <a href="{{ $field->sortQuery() }}" class="shrink-0" @click.prevent="canBeAsync">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" fill-opacity="{{ $field->sortType('asc') && $field->sortActive() ? '1' : '.5' }}" d="m11.47,4.72a0.75,0.75 0 0 1 1.06,0l3.75,3.75a0.75,0.75 0 0 1 -1.06,1.06l-3.22,-3.22l-3.22,3.22a0.75,0.75 0 0 1 -1.06,-1.06l3.75,-3.75z" clip-rule="evenodd"></path>
                                                    <path fill-rule="evenodd" fill-opacity="{{ $field->sortType('desc') && $field->sortActive() ? '1' : '.5' }}" d="m12.53,4.72zm-4.81,9.75a0.75,0.75 0 0 1 1.06,0l3.22,3.22l3.22,-3.22a0.75,0.75 0 1 1 1.06,1.06l-3.75,3.75a0.75,0.75 0 0 1 -1.06,0l-3.75,-3.75a0.75,0.75 0 0 1 0,-1.06z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </th>
                            @endforeach


                        </x-slot:thead>

                        <x-slot:tbody>
                            {{-- @include("crud.table-body-karyawan", [$resources]) --}}
                        </x-slot:tbody>

                        <x-slot:tfoot x-ref="foot" ::class="actionsOpen ? 'translate-y-none ease-out' : '-translate-y-full ease-in hidden'">
                            @includeWhen(!$resource->isPreviewMode(), "moonshine::crud.shared.table-foot", [$resource])
                        </x-slot:tfoot>
                    </x-moonshine::table>

                    {{-- @if($resource->isPaginationUsed() && !$resource->isPreviewMode())
                        {{ $resources->links($resource::$simplePaginate ? 'moonshine::ui.simple-pagination' : 'moonshine::ui.pagination') }}
                    @endif --}}
                @else
                    <x-moonshine::alert type="default" class="my-4" icon="heroicons.no-symbol">
                        {{ trans('moonshine::ui.notfound') }}
                    </x-moonshine::alert>
                @endif
            </div>
        </div>
</x-moonshine::box>

@if(!$resource->isPreviewMode())
    @include("moonshine::crud.shared.detail-card-actions", ["item" => $item, "resource" => $resource])
@endif


@foreach($resource->getFields()->relatable() as $field)
    @if($field->canDisplayOnForm($item))
        {{ $resource->renderComponent($field, $item) }}
    @endif
@endforeach

@if($resource->componentsCollection()->detailComponents()->isNotEmpty())
    @foreach($resource->componentsCollection()->detailComponents() as $detailComponent)
        @if($detailComponent->isSee($item))
            {{ $resource->renderComponent($detailComponent, $item) }}
        @endif
    @endforeach
@endif
