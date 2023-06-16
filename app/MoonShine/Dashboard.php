<?php

namespace App\MoonShine;

use App\Models\Holiday;
use App\Models\Karyawan;
use MoonShine\Dashboard\DashboardScreen;
use MoonShine\Dashboard\DashboardBlock;
use MoonShine\Dashboard\TextBlock;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Metrics\LineChartMetric;
use MoonShine\Metrics\DonutChartMetric;
use MoonShine\Metrics\ValueMetric;
use App\Models\Absensi;
use App\MoonShine\Resources\AbsensiResource;
use Illuminate\Support\Carbon;
use MoonShine\Dashboard\ResourcePreview;
use Illuminate\Support\Facades\DB;

class Dashboard extends DashboardScreen
{
	public function blocks(): array
	{
        $currentDate = Carbon::now()->subMonth();
        $endDateOfMonth = $currentDate->endOfMonth();
        $EndDate = $endDateOfMonth->format('Y-m-d');


        // $today = Carbon::now()->format('Y-m-d');
        $today ='2023-05-25';

        $dateOf26thLastMonth = $currentDate->subMonthNoOverflow()->setDay(26);
        $StartDate = $dateOf26thLastMonth->format('Y-m-d');

        // dd($StartDate, $EndDate);

        $telat = Absensi::whereColumn('masuk', '>', 'jadwalmasuk')
                    ->where('masuk', 'IS NOT', NULL)
                    ->whereBetween('tanggal', [$StartDate, $EndDate])->count();

        $ontime = Absensi::whereColumn('masuk', '<', 'jadwalmasuk')
                    ->where('masuk', 'IS NOT', NULL)
                    ->whereBetween('tanggal', [$StartDate, $EndDate])->count();

        $sql =  "SELECT COUNT(*) AS absent
        FROM employee
        WHERE id NOT IN (
            SELECT karyawan_id
            FROM attendance
            WHERE tanggal BETWEEN '2023-04-26' AND '2023-05-25'
        )";
        $tdkHadir = DB::select(DB::raw($sql));



        $hari = Absensi::select('tanggal')
                    ->whereBetween('tanggal', [$StartDate, $EndDate])
                    ->groupBy('tanggal')->get();
        $harikerja = $hari->count();




        $totalabsen = $ontime + $telat + $tdkHadir[0]->absent;


		return [

                DashboardBlock::make([
                    TextBlock::make(
                        'Welcome to HRS BINA GROUP',
                        ''
                    )
                ]),

                DashboardBlock::make([
                    LineChartMetric::make('Kehadiran bulan lalu')
                        ->line([
                            'Hadir' => Absensi::query()
                            ->selectRaw('DATE_FORMAT(tanggal, "%d/%m") AS tgl, COUNT(DISTINCT karyawan_id) AS work')
                            ->whereBetween('tanggal', [$StartDate, $EndDate])
                            ->where('masuk' , '!=' , null)
                            ->groupBy('tanggal')
                            ->pluck('work', 'tgl')
                            ->toArray()
                        ])->columnSpan(8),

                    DonutChartMetric::make('%')
                    ->values(['Ontime = ' . round(($ontime/$totalabsen)*100) . ' %' => round(($ontime/$totalabsen)*100)
                    , 'Terlambat = '.  round(($telat/$totalabsen)*100) . ' %' => round(($telat/$totalabsen)*100)
                    , 'Tdk-hadir = '. round(($tdkHadir[0]->absent/$totalabsen)*100) . ' %' => round(($tdkHadir[0]->absent/$totalabsen)*100)])->columnSpan(4),
                ]),

                DashboardBlock::make([
                    ValueMetric::make('Total Karyawan Aktif')
                    ->value(Karyawan::query()->where('active', 1 )->count())->columnSpan(6),
                    ValueMetric::make('Total Hari Kerja')
                    ->value($harikerja)->columnSpan(6),
                ]),

                DashboardBlock::make([
                    ResourcePreview::make(
                        new AbsensiResource(),
                        'Kehadiran hari ini',
                        Absensi::query()->where('tanggal', $today)->where('masuk', '!=', null)->limit(10)
                    )
                ]),
        ];
	}
}
