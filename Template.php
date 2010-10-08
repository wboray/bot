<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Template
 *
 * @author lubyagin sergey
 */
abstract class Template {

    abstract function SetMethod($key = null, $value = null);
    abstract function GetMethod();

    abstract function SetActionUrl($key = null, $value = null);
    abstract function GetActionUrl();

    abstract function SetSendParam($key = null, $value = null);
    abstract function GetSendParam();

}
?>
