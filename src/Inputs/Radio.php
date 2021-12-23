<?php


namespace Dawn\CustomForm\Inputs;


use Dawn\CustomForm\Helpers\RowHelper;
use Dawn\Labels\Facades\Labels;
use Illuminate\Support\Str;

class Radio extends Field
{
    use Options;
    use Resolve;

    public static $type     = 'radio';
    public static $typeName = '单选';



}
