<?php

namespace frontend\modules\system\models;

require_once "D:\\xampp\htdocs\pos\/vendor/koolreport/core/autoload.php";

use \koolreport\KoolReport;
use \koolreport\processes\Filter;
use \koolreport\processes\TimeBucket;
use \koolreport\processes\Group;
use \koolreport\processes\Limit;

class KoolReportModel extends KoolReport
{
    function settings()
    {
        return array(
            "dataSources"=>array(
                "sakila_rental"=>array(
                    "connectionString"=>"mysql:host=localhost;dbname=operation",
                    "username"=>"root",
                    "password"=>"12345678",
                    "charset"=>"utf8"
                ),
            )
        ); 
    }    
}