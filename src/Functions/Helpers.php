<?php
declare(strict_types=1);

namespace App\Functions;

class Helpers
{
    public static function layout($page, $title){
        $title = $title;
        require_once __DIR__ . "/../../Views/layouts/header.php";
        require_once __DIR__ . "/../../Views/layouts/nav.php";
        require_once __DIR__ . "/../../Views/$page.php";
        require_once __DIR__ . "/../../Views/layouts/footer.php";
    }
}