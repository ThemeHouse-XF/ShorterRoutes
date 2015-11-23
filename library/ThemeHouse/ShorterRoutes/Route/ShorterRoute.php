<?php

/**
 * Route that looks for a shorter route.
 *
 * @see XenForo_Route_Interface
 *
 *
 */
class ThemeHouse_ShorterRoutes_Route_ShorterRoute implements XenForo_Route_Interface
{

    /**
     * Type of route that should be handled.
     * This is "public".
     *
     * @var string
     */
    protected $_routeType = '';

    public function __construct($routeType)
    {
        if ($routeType !== 'public') {
            throw new XenForo_Exception('Invalid route type. Must be "public"');
        }

        $this->_routeType = $routeType;
    }

    /**
     * Attempts to match the routing path.
     * See {@link XenForo_Route_Interface} for further details.
     *
     * @param string Routing path
     * @param Zend_Controller_Request_Http Request object
     * @param XenForo_Router Routing object
     *
     * @return false XenForo_RouteMatch
     */
    public function match($routePath, Zend_Controller_Request_Http $request, XenForo_Router $router)
    {
        list($prefix) = explode('/', $routePath);
        if ($prefix === '') {
            return false;
        }

        $delimQuoted = preg_quote(XenForo_Application::URL_ID_DELIMITER);
        $extension = '';
        $xenOptions = XenForo_Application::get('options');
        if ($xenOptions->th_shorterRoutes_extension) {
            $extension = preg_quote('.' . $xenOptions->th_shorterRoutes_extension);
        }
        if (!preg_match(
            '#^([^' . $delimQuoted . '^/]*' . $delimQuoted . ')?([a-zA-Z]+)([0-9]+)' . $extension . '#', $prefix,
            $matches)) {
            return false;
        }

        $title = $matches[1];
        $shorterPrefix = $matches[2];
        $integer = $matches[3];

        if ($shorterPrefix == 'f') {
            $routeClass = XenForo_Link::getPrefixHandlerClassName($this->_routeType, 'forums');
        } elseif ($shorterPrefix == 't') {
            $routeClass = XenForo_Link::getPrefixHandlerClassName($this->_routeType, 'threads');
        } else {
            return false;
        }

        if (!$routeClass) {
            return false;
        }

        $newRoutePath = $title . $integer . '/' . substr($routePath, strlen($prefix) + 1);

        return $this->_loadAndRunSubRule($routeClass, $newRoutePath, $request, $router);
    }

    /**
     * Loads the specified sub-rule and then tries to match it.
     *
     * @param string Route class name
     * @param string Route path to pass to match
     * @param Zend_Controller_Request_Http
     * @param XenForo_Router
     *
     * @return XenForo_RouteMatch false
     */
    protected function _loadAndRunSubRule($routeClass, $newRoutePath, Zend_Controller_Request_Http $request,
        XenForo_Router $router)
    {
        if (XenForo_Application::autoload($routeClass)) {
            $routeClass = XenForo_Application::resolveDynamicClass($routeClass, 'route_prefix');

            $route = new $routeClass();
            return $route->match($newRoutePath, $request, $router);
        } else {
            return false;
        }
    }
}