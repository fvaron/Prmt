<?php
/**
 * This file is part of Promethean_System for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_System
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    /* Configuration actualité */
    $installer->setConfigData('clnews/comments/need_confirmation', 1);
    $installer->setConfigData('clnews/comments/commentsperpage', 5);
    $installer->setConfigData('clnews/news/title', 'Actualités');
    $installer->setConfigData('clnews/news/metatitle', 'Actualités');
    $installer->setConfigData('clnews/news/route', 'actualites');
    $installer->setConfigData('clnews/news/showlatestnews', 1);
    $installer->setConfigData('clnews/news/latestitemscount', 5);
    $installer->setConfigData('clnews/news/showcategoryofnews', 0);
    $installer->setConfigData('clnews/news/enablelinkrout', 1);
    $installer->setConfigData('clnews/news/shortdescr_image_max_width', 360);
    $installer->setConfigData('clnews/news/shortdescr_image_max_height', 194);
    $installer->setConfigData('clnews/news/fulldescr_image_max_width', 410);
    $installer->setConfigData('clnews/news/fulldescr_image_max_height', 230);


    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}