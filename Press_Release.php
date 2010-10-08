<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EPress_Release
 *
 * @author lubyagin sergey
 */
class Press_Release extends Template{

    protected $template_xml = 'Press_Release.xml';


    protected $method = null;//методы для стратегий обращений робота
    protected $action_url = null;//урлы для стратегий обращений робота
    protected $send_param = null;//данные для стратегий обращений робота

    /*
     * получаем XML шаблон и парсим его
     * 1. парсим стратегии и заполняем для них поля автоматом из UserDataProject
     *
     */
    public function __construct(UserDataProject $UserDataProject){
        $fp = simplexml_load_file($this->template_xml);
        //var_dump($fp);
        if (isset($fp->rule)){
            foreach ($fp->rule as $value) {
                $rulename = (string)$value["rname"];
                $this->action_url[$rulename] = (string)$value->action;
                $this->method[$rulename] = (string)$value->method;
                echo 'rule <br />';
                if (isset($value->parameters->field)){
                    echo 'field <br />';
                    foreach ($value->parameters->field as $value1) {
                        $this->send_param[$rulename][(string)$value1["htmlname"]] = '';
                    }
                }else{

                }
            }
         }else{

         }
        //print_r ($this->action_url);
    }

    public function SetMethod($key = null, $value = null){
        $this->method[$key] = $value;
    }
    public function GetMethod(){
        return $this->method;
    }

    public function SetActionUrl($key = null, $value = null){
        $this->action_url[$key] = $value;
    }
    public function GetActionUrl(){
        return $this->action_url;
    }

    public function SetSendParam($key = null, $value = null){
        $this->send_param[$key] = $value;
    }
    public function GetSendParam(){
        return $this->send_param;
    }
}
?>
