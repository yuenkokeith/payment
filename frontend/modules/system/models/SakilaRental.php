<?php

namespace frontend\modules\system\models;

use \koolreport\KoolReport;
use \koolreport\processes\Filter;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;
use \koolreport\processes\Limit;

class SakilaRental extends KoolReportModel
{   
    protected function setup()
    {
        $this->src('sakila_rental')
        ->query("SELECT order_date, total_amount FROM `order`")
        ->pipe(new TimeBucket(array(
            "order_date"=>"month"
        )))
        ->pipe(new Group(array(
            "by"=>"order_date",
            "sum"=>"total_amount"
        )))
        ->pipe($this->dataStore('sale_by_month'));
    } 
}