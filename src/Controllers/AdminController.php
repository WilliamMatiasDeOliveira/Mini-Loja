<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Functions\Helpers;

class AdminController{

    public function dashboard(){
        Helpers::layout("admin/dashboard", "Dashboard");
    }
}