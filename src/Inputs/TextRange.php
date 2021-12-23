<?php


namespace Dawn\CustomForm\Inputs;


use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\This;

class TextRange extends Field
{

    use Resolve;

    public static $type = 'text-range';
    public static $typeName = '输入范围';
    /**
     * @var string $placeholder
     */
    protected $placeholder;

    /**
     * @return mixed
     */
    public function getPlaceholder() : string
    {
        return $this->placeholder;
    }

    /**
     * @param string $placeholder
     * @return  This
     */
    public function setPlaceholder(string $placeholder = null)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function variables(): array
    {
        $data = [
            'placeholder' => $this->placeholder
        ];
        return array_merge(parent::variables(), $data);
    }

    /**
     * @param array $data
     * @return $this
     */
    public static function resolve(array $data = []): TextRange
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
        $field->setPlaceholder($data['placeholder'] ?? null);
        $field->setMultiple((boolean)($data['multiple'] ?? false));
        $field->setExamples(($data['examples'] ?? []));
        return $field;
    }


}
