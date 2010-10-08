<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDataProject
 *
 * @author lubyagin sergey
 */
class UserDataProject extends UserData{

    protected  $title = 'тайтл';
    protected  $annotation = 'аннотация';
    protected  $text = 'текст';
    protected  $link = 'link';
    protected  $anchor = 'anchor';
    protected  $keywords = 'keywords';

    function SetTitle($value) {
        $this->title = $value;
    }
    function GetTitle() {
        return $this->title;
    }

    function SetAnnotation($value) {
        $this->annotation = $value;
    }
    function GetAnnotation() {
        return $this->annotation;
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
?>
