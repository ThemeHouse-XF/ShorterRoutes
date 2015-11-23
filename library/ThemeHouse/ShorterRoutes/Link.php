<?php

class ThemeHouse_ShorterRoutes_Link extends XenForo_Link
{

    /**
     * Builds a shorter link for a request that may have an integer param.
     * Output will be in the format [prefix]/[title].[int]/[action]/ or similar,
     * based on whether the correct values in data are set.
     *
     * @param string $shortRoute Link short route
     * @param string $action Link action
     * @param string $extension Link extension (for content type)
     * @param mixed $data Specific data to link to. If available, an array or an
     * object that implements ArrayAccess
     * @param string $intField The name of the field that holds the integer
     * identifier
     * @param string $titleField If there is a title field, the name of the
     * field that holds the title
     *
     * @return false string if no data is provided, the link otherwise
     */
    public static function buildShorterLinkWithIntegerParam($shortRoute, $action, $extension, $data, $intField,
        $titleField = '')
    {
        if ((is_array($data) || $data instanceof ArrayAccess) && isset($data[$intField])) {
            self::prepareExtensionAndAction($extension, $action);

            $title = (($titleField && !empty($data[$titleField])) ? $data[$titleField] : '');
            $link = self::buildShorterIntegerAndTitleUrlComponent($shortRoute, $data[$intField], $title);
            $xenOptions = XenForo_Application::get('options');
            if ($xenOptions->th_shorterRoutes_slashAtEnd || $action) {
                return $link . "/$action$extension";
            }
            return $link;
        } else {
            return false;
        }
    }

    /**
     * Builds the URL component for an integer and title.
     * Outputs <int> or <title>.<shorterRoute><int>.
     *
     * @param string $shortRoute
     * @param integer $integer
     * @param string $title
     * @param boolean|null $romanize If true, non-latin strings are romanized.
     * If null, use default setup
     *
     * @return string
     */
    public static function buildShorterIntegerAndTitleUrlComponent($shortRoute, $integer, $title = '', $romanize = null)
    {
        $extension = '';
        $xenOptions = XenForo_Application::get('options');
        if ($xenOptions->th_shorterRoutes_extension) {
            $extension = '.' . $xenOptions->th_shorterRoutes_extension;
        }

        if ($title && XenForo_Application::get('options')->includeTitleInUrls) {
            if ($romanize === null) {
                $romanize = self::$_romanizeTitles;
            }
            $title = self::getTitleForUrl($title, $romanize);
            if ($title !== '') {
                return urlencode($title) . XenForo_Application::URL_ID_DELIMITER . $shortRoute . intval($integer) . $extension;
            }
        }

        return $shortRoute . intval($integer) . $extension;
    }
}