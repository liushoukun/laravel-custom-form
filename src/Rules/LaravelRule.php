<?php


namespace Dawn\CustomForm\Rules;


trait LaravelRule
{
    public function passes($attribute, $value)
    {
    }

    public function message()
    {
    }

    public function realRule()
    {

        if ($this::$hasRuleValue) {
            return (string)(self::$name . ':' . $this->rule);
        }
        return self::$name;
    }


    public static function checkRule($rule)
    {
        return true;
    }
}
