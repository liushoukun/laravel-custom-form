<?php


namespace Dawn\CustomForm;


use Dawn\CustomForm\Inputs\Field;
use Dawn\CustomForm\Rules\Min;
use Dawn\CustomForm\Rules\Rule;
use function Symfony\Component\String\b;

class FormRule
{

    /**
     * @param array|null $rules
     * @param null $data
     * @param null $parameters
     * @param Field $field
     * @return array
     */
    public static function makeRules(array $rules = null, $data = null, $parameters = null,Field $field)
    {
        $newRules = [];
        if (blank($rules)) {
            return [];
        }
        $ruleList = self::rules();
        /**
         * @var $object Rule
         */
        foreach ($rules as $ruleItem) {
            $type       = $ruleItem['type'];
            $rule       = $ruleItem['value'];
            $message    = $ruleItem['message'];
            $object     = new  $ruleList[$type]($rule, $message, $data, $parameters,$field);
            $newRules[] = ($object)->realRule();
        }
        return $newRules;
    }

    public static function checkRule($type, $rule = null, $message = '')
    {
        // 验证
        $rules = self::rules();
        if (!in_array($type, array_keys($rules))) {
            throw  new \Exception('Method does not exist.', 21);
        }
        // 判断是否符合规则
        $class = $rules[$type];
        $class::checkRule($rule);
        return true;
    }

    //  所有规则
    public static function rules()
    {
        return [
            'required' => \Dawn\CustomForm\Rules\Required::class,
            'url'      => \Dawn\CustomForm\Rules\Url::class,
            'max'      => \Dawn\CustomForm\Rules\Max::class,
            'min'      => \Dawn\CustomForm\Rules\Min::class,
            'email'    => \Dawn\CustomForm\Rules\Email::class,
            'length'   => \Dawn\CustomForm\Rules\Length::class,
            'rows'     => \Dawn\CustomForm\Rules\Rows::class,
            'regex'    => \Dawn\CustomForm\Rules\Regex::class,
            'remote'   => \Dawn\CustomForm\Rules\Remote::class,
            'numeric'   => \Dawn\CustomForm\Rules\Numeric::class,
        ];
    }
}
