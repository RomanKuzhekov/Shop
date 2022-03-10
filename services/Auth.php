<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 10:31
 */

namespace app\services;

use app\models\Session;
use app\models\User;

/**
 * Class Auth
 * @package app\services
 */
class Auth
{
    protected $sessionKey = 'sid';

    public function getSessionId()
    {
        $sid = $_SESSION[$this->sessionKey];
        if (is_null($sid)) {
            (new Session())->updateLastTime($sid);
        }
        return $sid;
    }

    public function openSession(User $user)
    {
        $sid = $this->generateStr();
        (new Session())->createNew($user->id, $sid, date("Y-m-d H:i:s"));
        $_SESSION[$this->sessionKey] = $sid;
        $_SESSION['idUser'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['login'] = $user->login;
    }

    public function generateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }
}