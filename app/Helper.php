<?php

if (!function_exists('dp')) {

    function dp($data = null, $stop = 0): array
    {
        echo '<pre>';
        print_r($data);
        if ($stop === 1) {
            exit('</pre><hr>');
        } else {
            echo '</pre><hr>';
        }

    }

}

if (!function_exists('tr_ucfirst_all')) {

    function tr_ucfirst_all($str): string
    {
        $str = str_replace(['I', 'i'], ['ı', 'İ'], $str);

        $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
        return str_replace('i̇', 'i', $str);
    }

}
