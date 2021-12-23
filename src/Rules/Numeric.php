<?php

namespace Dawn\CustomForm\Rules;

class Numeric extends Rule
{

    use LaravelRule;

    public static $name = 'numeric';
    public static $label = '数字';
}
