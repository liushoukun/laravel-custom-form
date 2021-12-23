<?php


namespace Dawn\CustomForm\Inputs;


use This;

class DatetimeRange extends Field
{
    use Resolve;

    public static $type     = 'datetime-range';
    public static $typeName = '日期时间范围';


    public function variables() : array
    {
        $data = [

        ];


        return array_merge(parent::variables(), $data);
    }


    public static function resolve(array $data = []) : DatetimeRange
    {
        $field = new self($data['name'] ?? null);
        $field->setLabel($data['label'] ?? null);
        $field->setName($data['name'] ?? null);
        $field->setValue($data['value'] ?? null);
        $field->setHelper($data['helper'] ?? null);
        $field->setHidden($data['hidden'] ?? null);
        $field->setRules($data['rules'] ?? null);
        $field->setSpan($data['span'] ?? 24);
        $field->setTools($data['tools'] ?? null);

        return $field;
    }


}
