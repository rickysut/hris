<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google;
?>
<div class="report-content">

    <div class="text-center">
        
        <p class="lead mb-4 mt-4">
            Turn-over across department and year
        </p>
    </div>
<?php 
$Y1 = date("Y");
$Y2 = date("Y")-1;
$Y3 = date("Y")-2;
Table::create(array(
    "dataStore" => $this->dataStore('todep'),
    "headers"=>array(
        array(
            ""=>array("colSpan"=>1),
            "TAHUN (Y1=".$Y1.', Y2='.$Y2.', Y3='.$Y3.')' =>array("colSpan"=>3),
        ),
        
    ),
    "showFooter"=>true,
        "columns"=>array(
            "department",
            "Y1"=>array(
                "suffix"=>" org",
                "cssStyle"=>"text-align:right",
                "footer"=>"sum",
                "footerText"=>"<b>Total:</b> @value"
            ),
            "Y2"=>array(
                "suffix"=>" org",
                "cssStyle"=>"text-align:right",
                "footer"=>"sum",
                "footerText"=>"<b>Total:</b> @value"
            ),
            "Y3"=>array(
                "suffix"=>" org",
                "cssStyle"=>"text-align:right",
                "footer"=>"sum",
                "footerText"=>"<b>Total:</b> @value"
            )
        ),
        "cssClass"=>array(
            "table"=>"table-bordered table-striped table-hover"
        )
));
?>



</div>
