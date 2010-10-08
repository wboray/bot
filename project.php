<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of userdata
 *
 * @author lubyagin segey
 */
    include './UserData.php';
    include './UserDataProject.php';
    include './Template.php';
    include './Press_Release.php';
    include './ROBOT.php';
    $obj_userdataproject = new UserDataProject();
    $obj_press_release = new Press_Release($obj_userdataproject);
    $obj_robot = new ROBOT($obj_press_release);
?>
