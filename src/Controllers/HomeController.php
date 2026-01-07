<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Functions\Helpers;

class HomeController{

    public function index(){
        Helpers::layout("app/home", "Home");
    }
}