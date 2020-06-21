<?php

if (!function_exists('d')) {
    function d(...$args) {
        $e = new \Exception();
        $trace = $e->getTrace()[0];
        dd($trace['line'] . ' - ' . $trace['file'], ...$args);
    }
}

if (!function_exists('bytes_to_human')) {
    function bytes_to_human($size, $unit="") {
        if( (!$unit && $size >= 1<<30) || $unit == "GB" )
            return number_format($size/(1<<30),2)."GB";
        if( (!$unit && $size >= 1<<20) || $unit == "MB" )
            return number_format($size/(1<<20),2)."MB";
        if( (!$unit && $size >= 1<<10) || $unit == "KB" )
            return number_format($size/(1<<10),2)."KB";
        return number_format($size)." bytes";

    }
}
