<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{}">
    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Legend');
            data.addColumn('number', 'days');
            data.addRows([
            ['Hadir', 20],
            ['Ijin', 1],
            ['Sakit', 1],
            ['Telat', 1],
            ['Plg-Cepat', 2]
            ]);

            // Set chart options
            var options = {'title':'Statistik Kehadiran',
                        'width':600,
                        'height':500};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        </script>

        @include('moonshine::layouts.shared.head')

        {!! app(\MoonShine\Utilities\AssetManager::class)->css() !!}

        @yield('after-styles')

        @stack('styles')

        {!! app(\MoonShine\Utilities\AssetManager::class)->js() !!}

        @yield('after-scripts')

        <style>
            [x-cloak] { display: none !important; }
        </style>

        <script>
            const translates = @js(__('moonshine::ui'));
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

    <body x-cloak x-data="{ minimizedMenu: $persist(false).as('minimizedMenu'), asideMenuOpen: false }">
        <div class="layout-wrapper" :class="minimizedMenu && 'layout-wrapper-short'">
            @section('sidebar')
                @include('moonshine::layouts.shared.sidebar')
            @show

            <div class="layout-page">
                @include('moonshine::layouts.shared.flash')

                @section('header')
                    @include('moonshine::layouts.shared.header')
                @show

                <main class="layout-content">
                    @yield('content')
                </main>

                @section('footer')
                    @include('moonshine::layouts.shared.footer')
                @show
            </div>
        </div>


        @stack('scripts')
    </body>
</html>
