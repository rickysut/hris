
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            var empdata = [
                ['Title', 'Total'],
                ['Hadir', 24],

            ];
            // var empData = [];
            console.log(empdata);
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable(empdata);
              var options = {
                title: 'Kehadiran karyawan',
                is3D: true,
                legend: { position: 'bottom' }
              };
              var chart = new google.visualization.PieChart(document.getElementById('empchart'));
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

        <main class="layout-content box grow">
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
                                    value="{{ $startMonth }}"
                                />
                                <x-moonshine::form.input
                                    type="month"
                                    name="bulan2"
                                    id="bulan2"
                                    @class(['form-input'])
                                    required
                                    value="{{ $endMonth }}"
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

                <div class="flex flex-col gap-y-8 gap-x-6 sm:grid sm:grid-cols-12 lg:gap-y-10">
                    <div class="space-y-6 col-span-12 xl:col-span-8">
                        {{-- <div class="box grow"> --}}
                            <div class="table-responsive mt-4">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            Bulan
                                        </th>
                                        <th>
                                            Hari Kerja
                                        </th>
                                        <th>
                                            Hadir
                                        </th>
                                        <th>
                                            TDK HADIR
                                        </th>
                                        <th>
                                            TELAT
                                        </th>
                                        <th>
                                            CUTI
                                        </th>
                                        <th>
                                            MANGKIR
                                        </th>
                                        <th>
                                            SAKIT
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">

                                    </tbody>

                                </table>
                            </div>
                        {{-- </div> --}}
                    </div>
                    <div class="space-y-6 col-span-12 xl:col-span-4">
                        {{-- <div class="box grow"> --}}
                            <div id="empchart" style="width: 100%; height: 400px"></div>
                        {{-- </div> --}}
                    </div>
                </div>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>


    $(document).ready(function(){
        window._token = $('meta[name="csrf-token"]').attr('content')
        $('#tombol').click(function(){
            var emp_id =  $('#nama').find(":selected").val();
            var periode1 = $('#bulan1').val();
            var periode2 = $('#bulan2').val();
            let route = '{{ route("performa.getdata") }}'

            $.ajax({
                headers: {'x-csrf-token' : _token},
                method: 'POST',
                url:'{{ route("performa.gettotal") }}',
                data: { eid: emp_id, startDate: periode1, endDate: periode2, _method: 'POST'},
                success: function(response) {
                    console.log(response);
                    var data=[];
                    var Header=['Title', 'Total']
                    data.push(Header);
                    response.forEach(rowData => {
                        var temp = [];
                        const hari = parseInt(rowData.tothari);
                        const hadir = parseInt(rowData.tothadir);
                        const tidakhadir = parseInt(rowData.tottdkhadir);
                        const haritelat = parseInt(rowData.totharitelat);
                        const cuti = parseInt(rowData.totcuti);
                        const mangkir = parseInt(rowData.totmangkir);
                        const sakit = parseInt(rowData.totsakit);

                        console.log(hadir);

                        var temp2 = [];
                        temp2.push('Hadir')
                        temp2.push(hadir);
                        data.push(temp2);

                        var temp3 = [];
                        temp3.push('Tdk Hadir')
                        temp3.push(tidakhadir)
                        data.push(temp3);

                        var temp4 = [];
                        temp4.push('Telat');
                        temp4.push(haritelat);
                        data.push(temp4);

                        var temp5 = [];
                        temp5.push('Cuti');
                        temp5.push(cuti);
                        data.push(temp5);

                        var temp6 = [];
                        temp6.push('Mangkir');
                        temp6.push(mangkir);
                        data.push(temp6);

                        var temp7 = [];
                        temp7.push('Sakit');
                        temp7.push(sakit);
                        data.push(temp7);

                    });
                   console.log(data);
                    var options = {
                        title: 'Kehadiran karyawan',
                        is3D: true,
                        legend: { position: 'bottom' }

                    };
                    var chartData = new google.visualization.arrayToDataTable(data);
                    var chart = new google.visualization.PieChart(document.getElementById('empchart'));
                    chart.draw(chartData, options);

                },
                error: function(errors){
                    alert('ERROR 1')
                }
            });



            $.ajax({
                headers: {'x-csrf-token' : _token},
                method: 'POST',
                url: route,
                data: { eid: emp_id, startDate: periode1, endDate: periode2, _method: 'POST'},
                success: function(response) {
                    //console.log(response)

                    const tableBody = document.getElementById('table-body');
                    let html = '';

                    response.forEach(rowData => {

                        const bulan = new Date(rowData.bulan).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                        html += '<tr>';
                        html += `<td>${bulan}</td>`;
                        html += `<td>${rowData.harikerja}</td>`;
                        html += `<td>${rowData.hadirkerja}</td>`;
                        html += `<td>${rowData.tidakhadir}</td>`;
                        html += `<td>${rowData.haritelat}</td>`;
                        html += `<td>${rowData.cuti}</td>`;
                        html += `<td>${rowData.mangkir}</td>`;
                        html += `<td>${rowData.sakit}</td>`;
                        // Add more columns as needed
                        html += '</tr>';
                    });

                    // Update the table body with the new HTML
                    tableBody.innerHTML = html;
                },
                error: function(errors){
                    alert('ERROR 2')
                }
            })
        });

    })

</script>
    </body>
</html>


