<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{}">
    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            var visitor = <?php echo $visitor; ?>;
            console.log(visitor);
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable(visitor);
              var options = {
                title: 'Kehadiran karywan',
                curveType: 'function',
                legend: { position: 'bottom' }
              };
              var chart = new google.visualization.PieChart(document.getElementById('linechart'));
              chart.draw(data, options);
            }
          </script>

    </head>
    <style>
        .layout-page {
            margin-top: 22px;
        }
        .layout-menu .menu-inner {
            margin-top: 28px;
        }
        @media (min-width: 640px) {
            .w-full {
                width: auto !important;
            }
        }
    </style>

    <body>

        <main class="layout-content">
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
                <div id="linechart" style="height: 500px"></div>



        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>


    $(document).ready(function(){

        $('#tombol').click(function(){
            var emp_id =  $('#nama').find(":selected").val();
            var periode = $('#bulan1').val();
            console.log(emp_id,  periode)
        });

    })

</script>
    </body>
</html>


