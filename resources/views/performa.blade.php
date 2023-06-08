@extends('layouts.app')
@section('content')
<x-moonshine::title
@class(['text-center','mb-4'])>
{{ trans('moonshine::ui.resource.performa') }}
</x-moonshine::title>
<x-moonshine::form.label name="nama" required>
    NIK - Nama
</x-moonshine::form.label>
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xl:col-span-10 mt-1">
        <x-moonshine::form.select
            name="nama"
            placeholder="Karyawan"
            value=""
            @class(['mt-2'])
            required
            nullable="false"
            searchable="false"
        >
            <x-slot:options>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->nik }} - {{ $employee->name }}</option>
                @endforeach
            </x-slot:options>
        </x-moonshine::form.select>
    </div>
    <div class="col-span-12 xl:col-span-2 mt-2">
        <a class="btn btn-primary w-full" href="#" id="tombol">
            <x-moonshine::icon icon="heroicons.outline.funnel" />
            Lihat
        </a>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $('#tombol').click(function(){
            alert("The paragraph was clicked.");
        });
    })
    
</script>

@endsection