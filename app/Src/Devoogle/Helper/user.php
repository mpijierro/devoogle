<?php

if ( ! function_exists('isLogged')) {

    function isLogged()
    {
        return (\Illuminate\Support\Facades\Auth::check());
    }
}

if ( ! function_exists('user')) {

    function user()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            return \Illuminate\Support\Facades\Auth::user();
        }

        throw new Exception('User not logged');
    }
}

if ( ! function_exists('isAdmin')) {

    function isAdmin()
    {

        $user = user();

        return $user->isAdmin();

    }
}
