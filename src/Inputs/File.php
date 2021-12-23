<?php


namespace Dawn\CustomForm\Inputs;


class File extends Field
{

    use Resolve;

    public static $type     = 'file';
    public static $typeName = '文件';

}
