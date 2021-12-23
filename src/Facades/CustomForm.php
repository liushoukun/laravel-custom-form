<?php

namespace Dawn\CustomForm\Facades;

use Dawn\CustomForm\Form;
use Illuminate\Support\Facades\Facade;

/**
 * Class CustomForm
 * @method static array create()
 * @method static array inputs()
 * @method static array resolve()
 * @package Dawn\CustomForm\Facades
 * @mixin  Form
 */
class CustomForm extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'custom-form';
    }
}
