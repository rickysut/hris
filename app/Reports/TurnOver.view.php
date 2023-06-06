<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google;
?>
<div class="report-content">

    <div class="text-center">
        
        <p class="lead mb-4 mt-4">
            Turn-over across months and year
        </p>
    </div>
<?php 
Table::create(array(
    "dataStore" => $this->dataStore('turnover'),
    'cssClass' => array('table' => 'table-condensed')
));
?>



</div>
