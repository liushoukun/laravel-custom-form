<?php


namespace Dawn\CustomForm\Inputs;


class CascadeSelect extends Field
{
    use Options;
    use Resolve;

    public static $type     = 'cascade-select';
    public static $typeName = '级联选择器';

}
