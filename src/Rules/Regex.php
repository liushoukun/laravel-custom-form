<?php


namespace Dawn\CustomForm\Rules;


class Regex extends Rule
{
    use LaravelRule;

    public static $name         = 'regex';
    public static $label        = '正则';
    public static $hasRuleValue = true;


    public function realRule()
    {

        return 'regex' . ':/' . $this->rule . '/';

    }


}
