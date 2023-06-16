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
                title: 'Site Visitor Line Chart',
                curveType: 'function',
                legend: { position: 'bottom' }
              };
              var chart = new google.visualization.LineChart(document.getElementById('linechart'));
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


