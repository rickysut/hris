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
use MoonShine\Metrics\ValueMetric;

class Dashboard extends DashboardScreen
{
	public function blocks(): array
	{
		return [

                DashboardBlock::make([
                    TextBlock::make(
                        'Welcome to HRS BINA GROUP',
                        ''
                    )
                ]),

                DashboardBlock::make([
                    ValueMetric::make('Total Karyawan Aktif')
                    ->value(Karyawan::where('ISAKTIF', 1)->count())->columnSpan(4),
                ]),
        ];
	}
}
