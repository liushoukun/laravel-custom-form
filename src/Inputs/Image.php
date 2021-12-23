<?php


namespace Dawn\CustomForm\Inputs;


class Image extends File
{
    use Resolve;
    public static $type = 'image';
    public static $typeName = '图片';
}
