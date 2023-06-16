<?php

namespace App\Http\Controllers;

use App\Models\Monthly;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Karyawan;

class PerformaController extends Controller
{
    public function getData(Request $request)
    {
        $emp_id = ($request->eid ?? 0);
        $start = ($request->startDate ?? 0);
        $end = ($request->endDate ?? 0);


        $nik = Karyawan::where('id', $emp_id)->select('nik')->first();

        $qryKehadiran = Monthly::whereRaw("DATE_FORMAT(bulan, '%Y-%m') BETWEEN ? AND ?", [$start, $end])
            ->where('nik' , $nik->nik)
            ->get();



        return $qryKehadiran;
    }

    public function getTotal(Request $request)
    {
        $emp_id = ($request->eid ?? 0);
        $start = ($request->startDate ?? 0);
        $end = ($request->endDate ?? 0);


        $nik = Karyawan::where('id', $emp_id)->select('nik')->first();

        $qryKehadiran = Monthly::selectRaw('
            SUM(harikerja) AS tothari,
            SUM(hadirkerja) AS tothadir,
            SUM(tidakhadir) AS tottdkhadir,
            SUM(haritelat) AS totharitelat,
            SUM(cuti) AS totcuti,
            SUM(mangkir) AS totmangkir,
            SUM(sakit) AS totsakit
        ')->whereRaw("DATE_FORMAT(bulan, '%Y-%m') BETWEEN ? AND ?", [$start, $end])
            ->where('nik' , $nik->nik)
            ->get();



        return $qryKehadiran;
    }

}
