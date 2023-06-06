@extends("moonshine::layouts.app")

@section('sidebar-inner')
    @parent
@endsection

@section('header-inner')
    @parent

    @include('moonshine::layouts.shared.breadcrumbs', [
        'items' => [
            $resource->route('index') => $resource->title(),
            '#' => $item->{$resource->titleField()} ?? $item->getKey() ?? trans('moonshine::ui.create')
        ]
    ])
@endsection


@section('content')
    @fragment('crud-detail')
    {{-- {{ dd($resource->detailView()) }} --}}
    @include($resource->detailView(), [
        'resource' => $resource,
        'item' => $item
    ])
    @endfragment
    <x-moonshine::link
    :href="$resource->route('index')"
    >
    {{ trans('moonshine::ui.back')}}
</x-moonshine::link>
@endsection

{{-- @ section('content')
    @include('moonshine::crud.shared.detail-card', [
        'resource' => $resource,
        'item' => $item
    ]) --}}




{{-- @endsection --}}
