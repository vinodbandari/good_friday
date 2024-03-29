<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

class Responsive
{
    const BREAKPOINT_OPTION_PREFIX = 'elementor_viewport_';

    private static $_default_breakpoints = array(
        'xs' => 0,
        'sm' => 576,
        'md' => 768,
        'lg' => 992,
        'xl' => 1200,
    );

    private static $_editable_breakpoints_keys = array(
        'md',
        'lg',
    );

    /**
     * @return array
     */
    public static function getDefaultBreakpoints()
    {
        return self::$_default_breakpoints;
    }

    /**
     * @return array
     */
    public static function getEditableBreakpoints()
    {
        return array_intersect_key(self::getBreakpoints(), array_flip(self::$_editable_breakpoints_keys));
    }

    /**
     * @return array
     */
    public static function getBreakpoints()
    {
        return array_reduce(array_keys(self::$_default_breakpoints), function ($new_array, $breakpoint_key) {
            if (!in_array($breakpoint_key, Responsive::$_editable_breakpoints_keys)) {
                $new_array[$breakpoint_key] = Responsive::$_default_breakpoints[$breakpoint_key];
            } else {
                $saved_option = get_option(Responsive::BREAKPOINT_OPTION_PREFIX . $breakpoint_key);
                $new_array[$breakpoint_key] = $saved_option ? (int) $saved_option : Responsive::$_default_breakpoints[$breakpoint_key];
            }

            return $new_array;
        }, array());
    }
}
