<?php


namespace Dawn\CustomForm\Inputs;


class Number extends Text
{
    use Resolve;

    public static $type     = 'number';
    public static $typeName = '数字输入';
}
