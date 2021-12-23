<?php


namespace Dawn\CustomForm\Inputs;


class Ip extends Text
{

    use Resolve;
    public static $type     = 'ip';
    public static $typeName = 'IP';

}
