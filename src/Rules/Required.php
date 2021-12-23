<?php


namespace Dawn\CustomForm\Rules;


class Required extends Rule
{
    use LaravelRule;

    public static $name  = 'required';
    public static $label = '必须填写';

}
