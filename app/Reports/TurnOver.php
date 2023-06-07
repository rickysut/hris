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
            ->query("
            select month as bulan, GROUP_CONCAT(y1) as Y1 , GROUP_CONCAT(y2) as Y2 , GROUP_CONCAT(y3) as Y3
            FROM
            (
            SELECT  MONTH(end_date) AS month,  COUNT(DISTINCT pin) AS y1 , null as y2, null as y3
                        FROM employee
                        WHERE end_date IS NOT NULL and YEAR(end_date) = Year(NOW())
                        GROUP BY month, YEAR(end_date)
                       
            UNION ALL
            
            SELECT  MONTH(end_date) AS month, null as y1, COUNT(DISTINCT pin) AS y2 , null as y3
                        FROM employee
                        WHERE end_date IS NOT NULL and YEAR(end_date) = Year(NOW())-1
                        GROUP BY month, YEAR(end_date)
            
            UNION ALL
            
            SELECT  MONTH(end_date) AS month, null as y1, null AS y2 , COUNT(DISTINCT pin)  as y3
                        FROM employee
                        WHERE end_date IS NOT NULL and YEAR(end_date) = Year(NOW())-2
                        GROUP BY month, YEAR(end_date)
                                    
            ) as dataku
            GROUP BY month
            ORDER BY month")
        
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