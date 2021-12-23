<?php

return [
    // 字段类型
    'fields' => [
        'text'           => \Dawn\CustomForm\Inputs\Text::class,
        'file'           => \Dawn\CustomForm\Inputs\File::class,
        'ip'             => \Dawn\CustomForm\Inputs\Ip::class,
        'number'         => \Dawn\CustomForm\Inputs\Number::class,
        'radio'          => \Dawn\CustomForm\Inputs\Radio::class,
        'select'         => \Dawn\CustomForm\Inputs\Select::class,
        'switch'         => \Dawn\CustomForm\Inputs\SwitchField::class,
        'textarea'       => \Dawn\CustomForm\Inputs\Textarea::class,
        'checkbox'       => \Dawn\CustomForm\Inputs\Checkbox::class,
        'image'          => \Dawn\CustomForm\Inputs\Image::class,
        'datetime-range' => \Dawn\CustomForm\Inputs\DatetimeRange::class,
        'cascade-select' => \Dawn\CustomForm\Inputs\CascadeSelect::class,
        'text-range'     => \Dawn\CustomForm\Inputs\TextRange::class,
        // ....
    ],
    'rules'  => [
        // 自定义规则
    ],
];
