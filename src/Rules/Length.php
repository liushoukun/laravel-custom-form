<?php


namespace Dawn\CustomForm\Rules;


use Dawn\CustomForm\Exceptions\FormTemplateException;
use Illuminate\Support\Str;

class Length extends Rule
{


    public static $name = 'length';
    public static $label = '长度';
    public static $hasRuleValue = true;

    public static function checkRule($rule)
    {
        if (!is_numeric($rule)) {
            throw new FormTemplateException('长度验证请输入数字', 1);
        }

    }

    public function passes($attribute, $value)
    {
        $length = Str::length($value);

        if ($length >= $this->rule) {
            if (blank($this->message)) {
                $this->message = $this->field->getLabel() . '长度不能超过' . $this->rule . '字符';
            }
            return false;
        }
        return true;
    }

    public function message()
    {
        return $this->message;
    }


}
