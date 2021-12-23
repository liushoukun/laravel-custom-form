<?php


namespace Dawn\CustomForm\Rules;

class Rows extends Rule
{


    public static $name = 'rows';
    public static $label = '行数校验';

    public static function checkRule($rule)
    {
        return true;
    }

    public function passes($attribute, $value)
    {
        try {
            $str   = preg_replace('~\r\n?~', "\n", $value);
            $array = explode("\n", $str);
            foreach ($array as $key => $item) {
                if (blank($item)) {
                    unset($array[$key]);
                }
            }
            $rows = count($array);
            if ($rows > $this->rule) {
                $this->message = '内容行数不能超过' . $this->rule . '!当前内容行数:' . $rows;
                return false;
            }
        } catch (\Exception $exception) {
            $this->message = '内容行数必须与数量一致检测出错';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }


}
