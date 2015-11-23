<?php

class ThemeHouse_ShorterRoutes_Listener_InitRouterPublic
{

    public static function initRouterPublic(XenForo_Dependencies_Abstract $dependencies, XenForo_Router $router)
    {
        $router->addRule(new ThemeHouse_ShorterRoutes_Route_ShorterRoute('public'), 'ShorterRoute');
    }
}