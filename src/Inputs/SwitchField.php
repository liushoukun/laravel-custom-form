<?php


namespace Dawn\CustomForm\Inputs;


class SwitchField extends Field
{
    use Resolve;
    public static $type     = 'switch';
    public static $typeName = '开关';

}
