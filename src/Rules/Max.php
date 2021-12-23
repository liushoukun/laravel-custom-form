<?php


namespace Dawn\CustomForm\Rules;


use Dawn\CustomForm\Exceptions\FormTemplateException;

class Max extends Rule
{
    public static $name = 'max';
    public static $label = '最大';
    public static $hasRuleValue = true;

    public static function checkRule($rule)
    {
        if (blank($rule)) {
            throw new FormTemplateException('最大值不能为空');
        }
        return true;
    }

    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        if (blank($this->message)) {

        }
        $this->value = $value;
        if ((int)$value > (int)$this->rule) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return str_replace(':max', $this->rule, $this->message ?? "超过最大值");
    }
}
