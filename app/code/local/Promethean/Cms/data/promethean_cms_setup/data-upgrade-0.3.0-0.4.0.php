<?php
/**
 * This file is part of Promethean_Cms for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Cms
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    $content = <<<HTML
{{block type="core/template" template="homepage/slider.phtml"}} {{block type="core/template" template="homepage/troisbloc.phtml"}} {{block type="core/template" template="homepage/actualite.phtml"}}
HTML;

    $cmsPage = Mage::getModel('cms/page')->load('home', 'identifier');
    $cmsPage->setLayoutUpdateXml('');
    $cmsPage->setContent($content);
    $cmsPage->setRootTemplate('one_column');
    $cmsPage->save();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}