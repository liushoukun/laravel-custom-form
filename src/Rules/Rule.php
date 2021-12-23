<?php


namespace Dawn\CustomForm\Rules;


use Dawn\CustomForm\Inputs\Field;
use phpDocumentor\Reflection\Types\Self_;

abstract class  Rule implements \Illuminate\Contracts\Validation\Rule
{

    protected $data;// 数据
    protected $message; // 信息
    protected $attribute;
    protected $value;
    protected $rule;
    protected $parameter;
    protected $field;

    public static $name;
    public static $label;
    public static $hasRuleValue = false;
    public static $ruleValueDescription = '';

    public function __construct($rule = null, $message = null, array $data = null, $parameter = null, Field $field)
    {
        $this->rule      = $rule;
        $this->message   = $message;
        $this->parameter = $parameter;
        $this->data      = $data;
        $this->field     = $field;
    }


    public function realRule()
    {
        return $this;
    }

    abstract public static function checkRule($rule);

    public static function ruleValueDescription()
    {
        return '';
    }
}
