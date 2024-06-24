<?php

if (!function_exists('loginTimeAgo')) {
    function loginTimeAgo()
    {
        if (session()->has('login_time')) {
            $loginTime = session('login_time');
            $timeDifference = now()->diffInMinutes($loginTime);
            return "Logged in $timeDifference min ago";
        }
        return "Not logged in";
    }
}