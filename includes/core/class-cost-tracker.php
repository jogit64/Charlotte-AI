<?php

if (!defined('ABSPATH')) {
    exit;
}

class CharlotteAI_Cost_Tracker
{
    const OPTION_NAME = 'charlotte_ai_cost_tracker';

    public static function add_cost($tokens, $cost)
    {
        $tracker = get_option(self::OPTION_NAME, ['tokens' => 0, 'cost' => 0.0]);
        $tracker['tokens'] += $tokens;
        $tracker['cost'] += $cost;

        update_option(self::OPTION_NAME, $tracker);
    }

    public static function get_tracker()
    {
        return get_option(self::OPTION_NAME, ['tokens' => 0, 'cost' => 0.0]);
    }

    public static function reset_tracker()
    {
        update_option(self::OPTION_NAME, ['tokens' => 0, 'cost' => 0.0]);
    }
}