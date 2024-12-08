<?php

if (!defined('ABSPATH')) {
    exit;
}

class UserSession
{
    public static function start_session()
    {
        if (!session_id()) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function destroy()
    {
        if (session_id()) {
            session_destroy();
        }
    }
}

add_action('init', ['UserSession', 'start_session'], 1);