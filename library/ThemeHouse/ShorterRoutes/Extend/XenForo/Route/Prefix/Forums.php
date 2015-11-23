<?php

/**
 *
 * @see XenForo_Route_Prefix_Forums
 */
class ThemeHouse_ShorterRoutes_Extend_XenForo_Route_Prefix_Forums extends XFCP_ThemeHouse_ShorterRoutes_Extend_XenForo_Route_Prefix_Forums
{

    /**
     *
     * @see XenForo_Route_Prefix_Forums::buildLink()
     */
    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        if (is_array($data) && !empty($data['node_name'])) {
            return parent::buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, $extraParams);
        } else {
            $action = XenForo_Link::getPageNumberAsAction($action, $extraParams);

            // for situations such as an array with thread and node info
            if (isset($data['node_title'])) {
                $data['title'] = $data['node_title'];
            }

            return ThemeHouse_ShorterRoutes_Link::buildShorterLinkWithIntegerParam('f', $action, $extension, $data,
                'node_id', 'title');
        }
    }
}