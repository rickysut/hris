<?php
namespace App\Reports;

use \koolreport\processes\ColumnMeta;
use \koolreport\processes\Limit;
use \koolreport\processes\RemoveColumn;
use \koolreport\processes\Sort;
use \koolreport\processes\ColumnsSort;
use \koolreport\processes\ValueMap;
use \koolreport\processes\Group;

class TurnOver extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    


    function setup()
    {
        
        $node = $this->src("mysql")
            ->query("select month as bulan, GROUP_CONCAT(total2023) as '2023', GROUP_CONCAT(total2022) as '2022' , GROUP_CONCAT(total2021) as '2021'
            FROM
            (
            SELECT  MONTH(end_date) AS month,  CONCAT(COUNT(DISTINCT pin), ' orang') AS total2023 , null as total2022, null as total2021
                        FROM employee
                        WHERE end_date IS NOT NULL and YEAR(end_date) = 2023
                        GROUP BY month, YEAR(end_date)
                       
            UNION ALL
            
            SELECT  MONTH(end_date) AS month, null as total2023, CONCAT(COUNT(DISTINCT pin), ' orang') AS total2022 , null as total2021
                        FROM employee
                        WHERE end_date IS NOT NULL and YEAR(end_date) = 2022
                        GROUP BY month, YEAR(end_date)
            
            UNION ALL
            
            SELECT  MONTH(end_date) AS month, null as total2023, null AS total2022 , CONCAT(COUNT(DISTINCT pin), ' orang')  as total2021
                        FROM employee
                        WHERE end_date IS NOT NULL and YEAR(end_date) = 2021
                        GROUP BY month, YEAR(end_date)
                                    
            ) as dataku
            GROUP BY month
            ORDER BY month
            ")
            ->pipe(new ColumnMeta(array(
                "bulan"=>array(
                    'type' => 'float',
                ),
            )))
            ->pipe(new ValueMap(array(
                "bulan"=>array(
                    1 => "January",
                    2 => "February",
                    3 => "March",
                    4 => "April",
                    5 => "May",
                    6 => "June",
                    7 => "July",
                    8 => "August",
                    9 => "September",
                    10 => "October",
                    11 => "November",
                    12 => "December",
                )
            )))
            ->pipe($this->dataStore('turnover'));
             
    }
}