<?php

/**
 *
 * @see XenForo_Route_Prefix_Threads
 */
class ThemeHouse_ShorterRoutes_Extend_XenForo_Route_Prefix_Threads extends XFCP_ThemeHouse_ShorterRoutes_Extend_XenForo_Route_Prefix_Threads
{

    /**
     *
     * @see XenForo_Route_Prefix_Forums::buildLink()
     */
    public function buildLink($originalPrefix, $outputPrefix, $action, $extension, $data, array &$extraParams)
    {
        $postHash = '';
        if ($action == 'post-permalink' && !empty($extraParams['post'])) {
            $post = $extraParams['post'];
            unset($extraParams['post']);

            if (!empty($post['post_id']) && isset($post['position'])) {
                if ($post['position'] > 0) {
                    $postHash = '#post-' . intval($post['post_id']);
                    $extraParams['page'] = floor(
                        $post['position'] / XenForo_Application::get('options')->messagesPerPage) + 1;
                }
            }

            $action = '';
        }

        $action = XenForo_Link::getPageNumberAsAction($action, $extraParams);

        return ThemeHouse_ShorterRoutes_Link::buildShorterLinkWithIntegerParam('t', $action, $extension, $data, 'thread_id',
            'title') . $postHash;
    }
}