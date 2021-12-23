<?php


namespace Dawn\CustomForm\Inputs;


class Select extends Field
{
    use Options;
    use Resolve;
    public static $type     = 'select';
    public static $typeName = '下拉框';
}
