<?php

namespace Dawn\CustomForm\Helpers;

use Illuminate\Support\Str;

class RowHelper
{

    public static function count(string $text) : int
    {
        $text = preg_replace('~\r\n?~', "\n", $text);
        // 去除特殊字符
        $text = str_replace(" ️", "", $text);
        $text = str_replace("️", "", $text);
        // 去除制表符
        $text  = str_replace("	", '', $text);
        $text  = str_replace("      ", "", $text);
        $text  = str_replace("\\r", '', $text);
        $text  = str_replace("\\", '', $text);
        $array = explode("\n", $text);
        return count($array);
    }

    public static function works(string $text)
    {
        return Str::length($text);
    }
}
