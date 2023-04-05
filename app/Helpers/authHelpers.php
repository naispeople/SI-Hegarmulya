<?php

namespace App\Helpers;

class authHelpers
{
    public static function logged_in()
    {
        return  session()->logged_in;
    }

    public static function getUsername()
    {
        return session()->username;
    }

    public static function getNama()
    {
        return session()->nama;
    }

    public static function getEmail()
    {
        return session()->email;
    }

    public static function getRole()
    {
        return session()->jabatan;
    }

    public static function logout()
    {
        return session()->destroy();
    }
}
