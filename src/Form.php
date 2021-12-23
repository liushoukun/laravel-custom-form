<?php


namespace Dawn\CustomForm;


use Dawn\CustomForm\Inputs\Field;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Form
{

    protected $fields = [];

    public static function resolve(array $data)
    {
        $form   = new self();
        $fields = collect([]);
        foreach ($data as $item) {
            // 获取类型
            $type = $item['type'];
            /**
             * @var $class Field
             */
            try {
                $class  = config('forms.fields.' . $type);
                $object = $class::resolve($item);

                $fields->push($object);
            } catch (Exception $exception) {
                report($exception);

            }
        }
        $form->fields = $fields;
        return $form;

    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    public function add(Field $field)
    {
        $this->fields = collect($this->fields)->push($field);
        return $this;
    }

    public function variables()
    {
        $data = [];
        foreach ($this->fields as $field) {
            $data[] = $field->variables();
        }
        return $data;
    }

    public function toArray()
    {
        return $this->variables();
    }

    public function toJson()
    {
        return json_encode($this->variables());
    }

    public function variablesJson()
    {
        return json_encode($this->variables());
    }

    public function list()
    {
    }

    public function setValues(array $data = null)
    {
        /**
         * @var $field Field
         */
        foreach ($this->fields as &$field) {
            if (isset($data[$field->getName()])) {
                $field->setValue($data[$field->getName()]);
            }
            // 如果是多个情况下必须是数组
            if ($field->isMultiple()) {
                $value = $field->getValue() ?? [];
                if (!is_array($value)) {
                    $value = [$value];
                }
                $value[0] = $value[0] ?? null;
                $field->setValue($value);
            }

        }
        return $this;
    }

    public function getValues()
    {
        $values = [];
        /**
         * @var $field Field
         */
        foreach ($this->fields as $field) {
            $values[$field->getName()] = $field->getValue();
        }
        return $values;
    }

    public function getShowLabels()
    {
        $valueLabels = [];
        /**
         * @var $field Field
         */
        foreach ($this->fields as $field) {
            $valueLabels[] = $field->showLabel();
        }
        return $valueLabels;

    }

    /**
     * 便宜数据后返回
     *
     * @param null $data
     * @param null $parameters
     * @return Form
     * @throws ValidationException
     */
    public function validate($data = null, $parameters = null)
    {
        // 初始化默认数据
        $data = $this->defaultValue($data);
        // 校验数据
        $this->setValues($data);
        $rules = $this->makeRules($data, $parameters);

        $customAttributes = [];
        $message          = [];
        /**
         * @var $field Field
         */
        foreach ($this->fields as $field) {
            if ($field->isMultiple()) {
                $customAttributes[$field->getName() . '.*'] = $field->getLabel();
            } else {
                $customAttributes[$field->getName()] = $field->getLabel();
            }
            foreach ($field->getRules() as $rule) {
                if (filled($rule['message'])) {
                    $ruleName = $field->getName() . '.' . $rule['type'];
                    $message[$ruleName] = $rule['message'];
                }
            }
        }
        $message['regex']    = ' :attribute格式错误';
        $message['required'] = ':attribute必须填写';
        $message['url'] = ':attribute必须为链接';
        $message['numeric'] = ':attribute必须是数字';
        $message['length'] = ':attribute 长度不能超过 :length';
        $message['max'] = ':attribute 最大不能超过 :max';
        $message['min'] = ':attribute 最小不能小于 :min';
        $message['email'] = ':attribute 必须为邮箱格式';
        $validator = Validator::make($data, $rules, $message, $customAttributes);
        $validator->validate();
        return $this;
    }

    public function defaultValue($data = [])
    {
        $defaultValue = [];

        foreach ($this->fields as $field) {
            $defaultValue[$field->getName()] = $field->getValue();
        }

        foreach ($this->fields as $field) {
            // 如果是多个情况下必须是数组
            if ($field->isMultiple()) {
                $value = $data[$field->getName()] = $data[$field->getName()] ?? $defaultValue[$field->getName()] ?? null;
                if (!is_array($value)) {
                    $value = [$value];
                }
                $value[0]                = $value[0] ?? null;
                $data[$field->getName()] = $value;
            } else {
                if(blank($data[$field->getName()]??null)){
                    $data[$field->getName()] =  $defaultValue[$field->getName()] ?? null;
                }
            }


        }
        return $data;
    }

    /**
     * 生产表单
     *
     * @param array|null $data
     * @param array|null $parameters
     * @return array
     */
    public function makeRules(array $data = null, array $parameters = null)
    {
        $rules = [];
        /**
         * @var $field Field
         */
        foreach ($this->fields as $field) {
            // 判断是否需要验证 隐藏
            if ($field->isMultiple()) {
                $rules[$field->getName() . '.*'] = FormRule::makeRules($field->getRules(), $data, $parameters, $field);
            } else {
                $rules[$field->getName()] = FormRule::makeRules($field->getRules(), $data, $parameters, $field);

            }
        }

        return $rules;
    }

    /**
     * @param $hidden
     * @return bool
     * @throws Exception
     */
    protected function isHidden($hidden)
    {
        if ($hidden['status'] == false) {
            return false;
        }
        try {
            $fieldValue = 1;
            $value      = $hidden['value'] ?? '';
            $where      = trim($hidden['where']);
            switch ($where) {
                case '!=':
                    if ($fieldValue != $value) {
                        return true;
                    }
                    break;
                case '==':
                    if ($fieldValue == $value) {
                        return true;
                    }
                    break;
                case '>':
                    if ($fieldValue > $value) {
                        return true;
                    }
                    break;
                case '>=':
                    if ($fieldValue >= $value) {
                        return true;
                    }
                    break;
                case '<':
                    if ($fieldValue < $value) {
                        return true;
                    }
                    break;
                case '<=':
                    if ($fieldValue <= $value) {
                        return true;
                    }
                    break;
                case 'in':
                    $value = explode(',', $hidden['value']);
                    if (in_array($fieldValue, $value)) {
                        return true;
                    }
                    break;
                case 'not_in':
                    $value = explode(',', $hidden['value']);
                    if (!in_array($fieldValue, $value)) {
                        return true;
                    }
                    break;
                default:
                    throw new Exception("找不where条件");
            }
        } catch (Exception $exception) {
            report($exception);
            throw $exception;
        }

        return false;

    }
}
