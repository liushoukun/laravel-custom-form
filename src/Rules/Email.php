<?php


namespace Dawn\CustomForm\Rules;


class Email extends Rule
{
    use LaravelRule;

    public static $name  = 'email';
    public static $label = '邮箱';

}
