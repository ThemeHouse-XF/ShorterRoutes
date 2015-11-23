<?php

class ThemeHouse_ShorterRoutes_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_ShorterRoutes' => array(
                'route_prefix' => array(
                    'XenForo_Route_Prefix_Forums',
                    'XenForo_Route_Prefix_Threads'
                ), 
            ), 
        );
    }

    public static function loadClassRoutePrefix($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_ShorterRoutes_Listener_LoadClass', $class, $extend, 'route_prefix');
    }
}