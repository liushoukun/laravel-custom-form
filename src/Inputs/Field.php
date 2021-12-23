<?php


namespace Dawn\CustomForm\Inputs;


use Dawn\CustomForm\FormRule;
use Dawn\Labels\Facades\Labels;
use Exception;

abstract class Field implements ResolveInterface
{

    public static $type = null;

    public static $typeName = null;

    protected $name;

    protected $label;

    protected $value;

    protected $helper;

    protected $rules; // 规则

    protected $hidden; // 不显示条件

    protected $tools;

    protected $multiple = false;
    protected $span     = 24;


    protected  $examples = [];

    /**
     * @return int
     */
    public function getSpan() : int
    {
        return $this->span;
    }

    /**
     * @param int $span
     */
    public function setSpan(int $span) : void
    {
        $this->span = $span;
    } // 栅格栏

    public function __construct(string $name, string $label = null)
    {
        $this->setName($name);
        $this->setLabel(($label ?? $name));
    }


    /**
     * @return mixed
     */
    public function getName() : string
    {
        // todo check name
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return $this
     */
    public function setLabel(string $label = null)
    {
        $this->label = (string)$label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getValueLabel()
    {
        return $this->value;
    }

    /**
     * @param  $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHelper() : string
    {
        return $this->helper;
    }

    /**
     * 获取示例
     * @return array
     */
    public function getExamples() : array
    {
        return $this->examples;
    }

    /**
     * 设置示例
     * @param array $examples
     * @return $this
     */
    public function setExamples(array $examples)
    {
        $this->examples = $examples;
        return $this;
    }



    /**
     * @param  $helper
     * @return $this
     */
    public function setHelper(string $helper = null)
    {
        $this->helper = $helper;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param array|null $rules
     * @return $this
     * @throws Exception
     */
    public function setRules(array $rules = null)
    {
        // 校验规则
        if ($rules != null) {
            foreach ($rules as $rule) {
                FormRule::checkRule($rule['type'], $rule['value'] ?? null, ($rule['message'] ?? ''));
            }
        }

        $this->rules = $rules;
        return $this;
    }

    protected function checkRule()
    {
    }

    /**
     * @return mixed
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param  $hidden
     * @return $this
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTools()
    {
        return $this->tools;
    }

    /**
     * @param  $tools
     * @return $this
     */
    public function setTools($tools)
    {
        $this->tools = $tools;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMultiple() : bool
    {
        return (boolean)$this->multiple;
    }

    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple)
    {
        $this->multiple = $multiple;
    }


    public function variables() : array
    {

        return [
            'type'     => (string)$this::$type,
            'name'     => (string)$this->name,
            'label'    => (string)$this->label,
            'rules'    => $this->rules ?? [],
            'value'    => $this->value,
            'tools'    => $this->tools ?? null,
            'helper'   => (string)$this->helper,
            'hidden'   => $this->hidden ?? null,
            'multiple' => $this->multiple ?? false,
            'span'     => $this->span ?? 24,
            'examples' => $this->examples ?? [],
        ];

    }

    public function showLabel() : array
    {
        $value = $this->value;
        if (is_array($this->value)) {
            $value = implode(',', $this->value);
        }

        $data = [
            'copy'  => (bool)($this::$copy ?? true), // 是否可复制
            'type'  => (string)$this::$type,
            'name'  => (string)$this->name,
            'label' => (string)$this->label,
            'value' => (string)$value,
        ];
        return (Labels::resolve($data))->toArray();

    }
}
