<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 *
 *
 * данные юзера
 *
 *
 *
 */

class UserData{

    public  $fam = 'фамилия';
    public  $otch = 'отчество';
    public  $name = 'имя';
    public  $phone = 'телефон';
    public  $facs = 'факс';
    public  $email = 'емайл';
    public  $site = 'сайт';
    public  $address = 'адрес';
    public  $firma = 'фирма';


    function SetName($value){
        $this->name = $value;
    }
    function GetName(){
        return $this->name;
    }

    function SetFam($value){
        $this->fam = $value;
    }
    function GetFam(){
        return $this->fam;
    }

    function SetOtch($value){
        $this->otch = $value;

    }
    function GetOtch(){
        return $this->otch;
    }

    function SetPhone($value){
        $this->phone = $value;
    }
    function GetPhone(){
        return $this->phone;
    }

    function SetFacs($value){
        $this->facs = $value;
    }
    function GetFacs(){
        return $this->facs;
    }

    function SetEmail($value){
        $this->email = $value;
    }
    function GetEmail(){
        return $this->email;
    }

    function SetSite($value){
        $this->site = $value;
    }
    function GetSite(){
        return $this->site;
    }

    function SetAddress($value){
        $this->address = $value;
    }
    function GetAddress(){
        return $this->address;
    }

    function SetFirma($value){
        $this->firma = $value;
    }
    function GetFirma(){
        return $this->firma;
    }

}

class UserDataProject extends UserData{

    public  $title = 'тайтл';
    public  $annotation = 'аннотация';
    public  $text = 'текст';
    public  $link = 'link';
    public  $anchor = 'anchor';
    public  $keywords = 'keywords';

    function SetTitle($value) {
        $this->title = $value;
    }
    function GetTitle() {
        return $this->title;
    }

    function SetText($value) {
        $this->text = $value;
    }
    function GetText() {
        return $this->text;
    }

    function SetLink($value) {
        $this->link = $value;
    }
    function GetLink() {
        return $this->link;
    }

    function SetAnchor($value) {
        $this->anchor = $value;
    }
    function GetAnchor() {
        return $this->anchor;
    }

    function SetKeywords($value) {
        $this->keywords = $value;
    }
    function GetKeywords() {
        return $this->keywords;
    }
}


/*
 *
 *
 *
 * ниже темплейты
 *
 *
 */

abstract class Template {

    abstract function SetMethod($key = null, $value = null);
    abstract function GetMethod();

    abstract function SetActionUrl($key = null, $value = null);
    abstract function GetActionUrl();

    abstract function SetSendParam($key = null, $value = null);
    abstract function GetSendParam();

    abstract function SetParametersArray(UserDataProject $UserDataProject);
    abstract function GetParametersArray();

}


/*
 * Шаблон для сайта Press-release.ru
 */
class Press_Release extends Template{

    public $method = null;//методы для стратегий обращений робота
    public $action_url = null;//урлы для стратегий обращений робота
    public $send_param = null;//данные для стратегий обращений робота

    public $parameters = array();//данные проекта юзверя которые заполнены для него автоматом

    /*
     * тут вся стратегия для этого шаблона, т.е. тут нужно писать последовательности для робота
     */
    public function __construct(UserDataProject $UserDataProject) {
        //заполним поля автоматом
        $this->SetParametersArray($UserDataProject);

        //первая последовательность для робота
        //если есть страница авторизации то она будет первой последовательность
        //тут мы получаем форму для заполнения
        $this->SetActionUrl(1, 'http://www.press-release.ru/add/');
        $this->SetMethod(1, 'POST');
        $this->SetSendParam(1, null);
        //тут мы уже делаем submit
        //$this->SetActionUrl(2, 'http://www.press-release.ru/add/');
        //$this->SetMethod(2, 'POST');
        //$this->SetSendParam(2, null);
    }

    /*
     * тут делаем привязку полей страницы к нашим уже заполненным полям
     */
    public function SetParametersArray(UserDataProject $UserDataProject){
        $this->parameters['add[author]'] = $UserDataProject->fam . $UserDataProject->name . $UserDataProject->otch;
        $this->parameters['add[org]'] = $UserDataProject->firma;
        $this->parameters['add[contacts]'] = $UserDataProject->address;
        $this->parameters['add[email]'] = $UserDataProject->email;
        $this->parameters['add[title]'] = $UserDataProject->title;
        $this->parameters['add[annot]'] = $UserDataProject->annotation;
        $this->parameters['add[bodytext]'] = $UserDataProject->text;
        $this->parameters['add[keywords]'] = $UserDataProject->keywords;
        $this->parameters['add[url]'] = $UserDataProject->link;
        $this->parameters['add[url_name]'] = $UserDataProject->anchor;
        /*
         * эти данные нужно заполнить юзеру
         *
         *   $this->parameters['section']
         *   $this->parameters['code']
         */
   }
    public function  GetParametersArray() {
        return $this->parameters;
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




/*
 *
 *
 * класс робота
 *
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

    /*
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



$obj_userdataproject = new UserDataProject();
$obj_press_release = new Press_Release($obj_userdataproject);
$obj_robot = new ROBOT($obj_press_release);
?>
