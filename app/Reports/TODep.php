<?php
namespace App\Reports;

use \koolreport\processes\ColumnMeta;
use \koolreport\processes\Limit;
use \koolreport\processes\RemoveColumn;
use \koolreport\processes\Sort;
use \koolreport\processes\ColumnsSort;
use \koolreport\processes\ValueMap;
use \koolreport\processes\Group;

class TODep extends \koolreport\KoolReport
{
    use \koolreport\laravel\Friendship;
    


    function setup()
    {
        
        $node = $this->src("mysql")
            ->query("
            select st_departemen as department, GROUP_CONCAT(y1) as Y1 , GROUP_CONCAT(y2) as Y2 , GROUP_CONCAT(y3) as Y3
            FROM
            (
            SELECT  st_departemen,  COUNT(DISTINCT pin) AS y1 , null as y2, null as y3
                                    FROM employee
                                    WHERE end_date IS NOT NULL and YEAR(end_date) = Year(NOW())
                                    GROUP BY st_departemen, YEAR(end_date)
                                
            UNION ALL
            
            SELECT  st_departemen, null as y1, COUNT(DISTINCT pin) AS y2 , null as y3
                                    FROM employee
                                    WHERE end_date IS NOT NULL and YEAR(end_date) = Year(NOW())-1
                                    GROUP BY st_departemen, YEAR(end_date)
            
            UNION ALL
            
            SELECT  st_departemen, null as y1, null AS y2 , COUNT(DISTINCT pin)  as y3
                                    FROM employee
                                    WHERE end_date IS NOT NULL and YEAR(end_date) = Year(NOW())-2
                                    GROUP BY st_departemen, YEAR(end_date)
                                                            
            ) as dataku
            GROUP BY st_departemen
            ORDER BY st_departemen")
        
            
            ->pipe($this->dataStore('todep'));
             
    }
}