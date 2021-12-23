<?php


namespace Dawn\CustomForm\Inputs;


trait Resolve
{

    /**
     * @param array $data
     * @return Field
     */
    public static function resolve(array $data = []) :Field
    {
        $field = new self($data['name'] ?? null);

        $field->setLabel($data['label'] ?? null);
        $field->setValue($data['value'] ?? null);
        $field->setHelper($data['helper'] ?? null);
        $field->setHidden($data['hidden'] ?? null);
        $field->setRules($data['rules'] ?? null);
        $field->setTools($data['tools'] ?? null);
        $field->setSpan($data['span'] ?? 24);
        $field->setMultiple((boolean)($data['multiple'] ?? false));
        $field->setExamples(($data['examples'] ?? []));
        $hasOptions = [
                'checkbox',
                'select',
                'radio',
                'radio',
                'cascade-select'
        ];

        if (in_array($data['type'],$hasOptions,true)) {
            $field->setOptions($data['optional']['data'] ?? null);
        }
        return $field;
    }

}
