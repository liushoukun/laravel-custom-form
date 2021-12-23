<?php


namespace Dawn\CustomForm\Rules;


use Dawn\CustomForm\Exceptions\FormTemplateException;
use GuzzleHttp\Client;

class Remote extends Rule
{
    public static $name         = 'remote';
    public static $label        = '远程';
    public static $hasRuleValue = true;

    public static function checkRule($rule)
    {
        $pattern = "#(http|https)://(.*\.)?.*\..*#i";
        if (!preg_match($pattern, $rule)) {
            throw new FormTemplateException('远程校验请输入链接', 1);
        }
    }

    public function passes($attribute, $value)
    {
        try {
            $params = [
                'name'   => $this->field->getName(),
                'value'  => $value,
                'field'  => $this->field->variables(),
                'forms'  => $this->data,
                'params' => $this->parameter
            ];
            $client   = new Client([ 'timeout' => 10 ]);
            $response = $client->post($this->rule, [ 'http_errors' => false, 'form_params' => $params ]);
            $code     = $response->getStatusCode();

            if ($code == 200 || $code == 204) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $exception) {

            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
