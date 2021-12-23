<?php

namespace Dawn\CustomForm;

class CustomForm
{
    // Build wonderful things

    /**
     * 创建表单数据
     *
     * @return Form
     */
    public function create()
    {
        return new Form();
    }

    /**
     * 解析表单
     *
     * @param $data
     * @return \Dawn\CustomForm\Form
     * @throws \Dawn\CustomForm\Exceptions\FormTemplateException
     */
    public static function resolve($data)
    {
        return Form::resolve($data);
    }

    public static function inputs()
    {
        return [
            'text'     => [
                'value'      => 'text',
                'label'      => '文本框',
                'has_option' => false,
            ],
            'textarea' => [
                'value'      => 'textarea',
                'label'      => '多行文本框',
                'has_option' => false,
            ],
            'select'   => [
                'value'      => 'select',
                'label'      => '下拉框',
                'has_option' => true,
            ],
            'radio'    => [
                'value'      => 'radio',
                'label'      => '单选',
                'has_option' => true,
            ],
            'checkbox' => [
                'value'      => 'checkbox',
                'label'      => '多选',
                'has_option' => true,
            ],
            'switch'   => [
                'value'      => 'switch',
                'label'      => '开关',
                'has_option' => false,
            ],
//            'file'     => [
//                'value'      => 'file',
//                'label'      => '文件',
//                'has_option' => false,
//            ],
            'image'    => [
                'value'      => 'image',
                'label'      => '图片',
                'has_option' => false
            ]
        ];

    }


    // 构件表单验证
    public function buildFormValidate()
    {

    }

    // 表单验证
    public function formDataValidate($form, $data)
    {
    }

    /**
     * 不显示条件
     *
     * @return array
     */
    public static function hiddenWheres()
    {
        return [
            [
                'value' => "!=",
                'label' => '不等于',
            ],
            [
                'value' => "==",
                'label' => '等于',
            ],
            [
                'value' => ' > ',
                'label' => '大于',
            ],
            [
                'value' => ' >= ',
                'label' => '大于等于',
            ],
            [
                'value' => ' < ',
                'label' => '小于',
            ],
            [
                'value' => ' <= ',
                'label' => '小于等于',
            ],
            [
                'value' => 'in',
                'label' => '存在:(多个逗号隔开)',
            ],
            [
                'value' => 'not_in',
                'label' => '不存在:(多个逗号隔开)',
            ],

        ];

    }
}
