<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ROBOT
 *
 * @author lubyagin sergey
 */
class ROBOT{

    public $_STATUS = null;

    public $action_url = null;
    public $method = null;
    public $send_param = null;

    public function __construct(Template $obj_template) {
        $this->action_url = $obj_template->GetActionUrl();
        $this->method = $obj_template->GetMethod();
        $this->send_param = $obj_template->GetSendParam();
    }

    /***********************************************************************
     * тут нужно уметь обрабатывать последовательности
     */
    public function strategy() {
        if (!is_array($this->action_url)||!is_array($this->method)){
            $_STATUS = 'function strategy incorrect';
            return false;
        }else{
            foreach ($this->action_url as $key => $value) {

                switch ($this->method[$key]){
                    case 'GET':{
                            $this->Curl_GET_send($key);
                    break;}
                    case 'POST':{
                            $this->Curl_POST_send($key);
                    break;}
                    case 'AJAX':{

                    break;}
                }
           }
        }
    }

    public function Curl_POST_send($key = 1) {

        if ($this->method[$key] != 'POST'){
            $_STATUS = 'function Curl_POST_send incorrect';
            return false;
        }else{
            $ch = curl_init();

            curl_setopt ($ch, CURLOPT_URL, $this->action_url[$key]);
            curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            if (count_array($this->send_param[$key]) > 0){
                foreach ($this->send_param[$key] as $key => $value){
                    if (!empty($key)) curl_setopt ($ch, CURLOPT_POSTFIELDS, $key.'='.$value);
                }
            }
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
       }
    }

    public function Curl_GET_send($key = 1) {

        if ($this->method[$key] != 'GET'){$_STATUS = 'function Curl_GET_send';}else{
            $ch = curl_init();

            curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            if (count_array($this->send_param[$key]) > 0){
                $for_sen_action_url = $this->action_url[$key] . '?';
                foreach ($parameters as $key => $value){
                    if (!empty($key)) $for_sen_action_url .= $key . '=' . $value . '&';
                }
            }
            curl_setopt ($ch, CURLOPT_URL, $for_sen_action_url);

            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
       }
    }

}
?>
