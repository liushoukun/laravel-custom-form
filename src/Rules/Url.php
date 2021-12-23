<?php


namespace Dawn\CustomForm\Rules;


class Url extends Rule
{
    use LaravelRule;

    public static $name  = 'url';
    public static $label = '链接';

}
