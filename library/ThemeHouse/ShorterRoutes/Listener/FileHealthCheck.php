<?php

class ThemeHouse_ShorterRoutes_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/ShorterRoutes/Extend/XenForo/Route/Prefix/Forums.php' => 'aa71c803f8d682e43166060be9d431ba',
                'library/ThemeHouse/ShorterRoutes/Extend/XenForo/Route/Prefix/Threads.php' => '4af454af08a6baddac7aa2d4d11ee4fb',
                'library/ThemeHouse/ShorterRoutes/Install/Controller.php' => '15c1fcdc4e19c70f832b461564001f67',
                'library/ThemeHouse/ShorterRoutes/Link.php' => '1a5cf31c501aa4051480f701d94b8285',
                'library/ThemeHouse/ShorterRoutes/Listener/InitRouterPublic.php' => '9cbfc06cc063c50051e4c44a17d40126',
                'library/ThemeHouse/ShorterRoutes/Listener/LoadClass.php' => '152a0b46a6830cbd72689ad11a6496ce',
                'library/ThemeHouse/ShorterRoutes/Route/ShorterRoute.php' => '7adf958e81b966cb8d7c1b503e20c07d',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}