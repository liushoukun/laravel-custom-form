<?php
// +----------------------------------------------------------------------
// | When work is a pleasure, life is a joy!
// +----------------------------------------------------------------------
// | User: shook Liu  |  Email:24147287@qq.com  | Time: 2018/11/6 12:53
// +----------------------------------------------------------------------
// | TITLE: todo?
// +----------------------------------------------------------------------

namespace Dawn\CustomForm\Rules;

use Dawn\CustomForm\Exceptions\FormTemplateException;

class Min extends Rule
{

    public static $name = 'min';
    public static $label = '最小';
    public static $hasRuleValue = true;

    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        if (blank($this->message)) {

        }
        $this->value = $value;
        if ((int)$value < (int)$this->rule) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return str_replace(':min', $this->rule, $this->message ?? "超过最小值");
    }

    public static function checkRule($rule)
    {
        if (blank($rule)) {
            throw new FormTemplateException('最小值不能为空');
        }
        return true;
    }


}
