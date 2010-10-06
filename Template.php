<?php
/**
 * Description of Template
 *
 * @author Lubyagin Sergey
 */

/*
 * класс отсылки и приема чего нужно
 */
class Bot{
    public function  __construct(){

    }
}

/*
 * класс пользователей работающих с нашей системой для отправки данных
 */
class UserForm{
    public function  __construct(array $user_data = array()){
        $this->fam = $user_data['fam'];
        $this->otch = $user_data['otch'];
        $this->name = $user_data['name'];
        $this->phone = $user_data['phone'];
        $this->facs = $user_data['facs'];
        $this->email = $user_data['email'];
        $this->yousite = $user_data['yousite'];
        $this->address = $user_data['address'];
        $this->firma = $user_data['firma'];
    }
}

/*
 * абстрактный класс шаблонов
 */
abstract class Template {

    protected $url_site = null;
    protected $url_site_autorization = null;
    protected $url_site_add = null;

    protected $type_request = array(); //POST GET AJAX
    protected $for_send = array();

}

/*
 * класс для шаблона сайта http://www.press-release.ru/add/
 *
 */
class press_release extends Template{

    public function  __construct(array $type_request = array(), array $for_send = array()) {
        $this->url_site = 'http://www.press-release.ru';
        $this->url_site_add = 'http://www.press-release.ru/add/';
        $this->type_request = $type_request;
        $this->for_send = $for_send;
    }
}

/*
 * начальные данные рассылателя
 */
$user_data['fam'] = 'фамилия';
$user_data['otch'] = 'отчество';
$user_data['name'] = 'имя';
$user_data['phone'] = 'телефон';
$user_data['facs'] = 'факс';
$user_data['email'] = 'емайл';
$user_data['yousite'] = 'сайт';
$user_data['address'] = 'адрес';
$user_data['firma'] = 'фирма';

$obj_UserForm = new UserForm($user_data = array());



/*
 * данные для посылки в конкретнфй сайт
 */

$type_request = array();
$type_request['action'] = '/add/';
$type_request['method'] = 'post';

$for_send = array();
$for_send['add[author]'] = $obj_UserForm->fam . $obj_UserForm->name . $obj_UserForm->otch;
$for_send['add[org]'] = $obj_UserForm->firma;
$for_send['add[contacts]'] = $obj_UserForm->address;
$for_send['add[email]'] = $obj_UserForm->email;

$for_send['section'] = '402';
$for_send['add[title]'] = 'title';
$for_send['add[annot]'] = 'annotation';
$for_send['add[bodytext]'] = 'text';
$for_send['add[keywords]'] = 'keyword';
$for_send['add[url]'] = 'url';
$for_send['add[url_name]'] = 'url_name';
$for_send['code'] = '1231';

$obj_press_release = new press_release($type_request = array(), $for_send = array());
?>
