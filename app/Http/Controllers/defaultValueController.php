<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\numberOfJobPosted;
use App\Models\numberOfCompany;
use App\Models\numberOfEmployee;
use App\Models\Profit;
use App\Models\categoryCount;

class defaultValueController extends Controller
{
    public function defaultValue(){
        $profit=new profit;
        $profit->profits=0;
        $profit->save();

        $nuOfEm=new numberOfEmployee;
        $nuOfEm->numberOfEmployee=0;
        $nuOfEm->save();


        $nuOfCo=new numberOfCompany;
        $nuOfCo->numberOfCompany=0;
        $nuOfCo->save();

        $nuOfjoPo=new numberOfJobPosted;
        $nuOfjoPo->numberOfJobPosted=0;
        $nuOfjoPo->save();



    }



}
