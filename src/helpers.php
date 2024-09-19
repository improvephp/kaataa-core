<?php

use ImprovePhp\KaataaCore\Classes\Download;

if (! function_exists('download_kata')) {
    function download_kata(string $id)
    {
        dd(Download::kata($id));
    }
}
