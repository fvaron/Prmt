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

    $cmsPages = array(
        'faq',
        'attouts-de-promethean',
        'entreprise-produits-education',
        'reconnaitre-gammes-promethean',
        'licences-logicielles-promethean',
        'activer-activinspire',
        'licences-gratuites-promethean',
        'logiciels-promethean-autres-marques',
        'activglide',
        'visioconference',
        'promethean-applications'
    );

    foreach($cmsPages as $cms) {
        /* @var $cmsBlockModel Mage_Cms_Model_Page */
        $cmsPageModel = Mage::getModel('cms/page');
        $cmsPageModel->load($cms, 'identifier');

        // Delete CMS page if it exist
        if ($cmsPageModel->getId()) {
            $cmsPageModel->delete();
        }
    }

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}