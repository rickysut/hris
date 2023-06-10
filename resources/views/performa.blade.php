

<x-moonshine::title
@class(['text-center','mb-4'])>
{{ trans('moonshine::ui.resource.performa') }}
</x-moonshine::title>
<form class="form" method="POST">
    @csrf
    <div class="flex flex-col items-center">
        <div class="form-group">
            <x-moonshine::form.label name="bulan" for="bulan1" required>
                Periode
            </x-moonshine::form.label>

            <div class="flex flex-row items-center  space-x-6">

                <x-moonshine::form.input
                    type="month"
                    name="bulan1"
                    id="bulan1"
                    @class(['form-input'])
                    required
                />
                <x-moonshine::form.input
                    type="month"
                    name="bulan2"
                    id="bulan2"
                    @class(['form-input'])
                    required
                />
            </div>
        </div>
        <div class="form-group">
            <x-moonshine::form.label name="nama" for="nama" required>
                NIK - Nama
            </x-moonshine::form.label>

            <x-moonshine::form.select
                name="nama"
                id="nama"
                placeholder="Karyawan"
                value=""
                @class(['form-input'])
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

    </div>
    <div class="md:flex-shrink-0">
        <a class="btn btn-primary w-full" href="#" id="tombol">
            <x-moonshine::icon icon="heroicons.outline.funnel" />
            Lihat
        </a>
    </div>
</form>

<div class="flex flex-col gap-y-8 gap-x-6 sm:grid sm:grid-cols-12 lg:gap-y-10 mt-4">
    <div class="space-y-6 col-span-12 xl:col-span-12">
        <div id="chart_div" style="max-width:700px; height:400px"></div>
    </div>

    <div class="space-y-6 col-span-12 xl:col-span-12">

    </div>

</div>




@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>


        $(document).ready(function(){

            $('#tombol').click(function(){
                var emp_id =  $('#nama').find(":selected").val();
                var periode = $('#bulan').val();
                console.log(emp_id,  periode)
            });

        })

    </script>
@endpush
