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

    $blockIdentifier4 = "footer-sociaux";
    $blockContent4 = <<<HTML
<div class="footer-sociaux">
    <span class="title-footer-menu">Suivez nous</span>
    <span class="link">
        <a target="_blank" href="http://www.youtube.com/c/PrometheanFrProInteractive"><img src="{{skin url="images/media/youtube.jpg"}}" alt="Youtube" /></a>
        <a target="_blank" href="https://plus.google.com/+PrometheanFrProInteractive"><img src="{{skin url="images/media/google.jpg"}}" alt="Google +" /></a>
        <a target="_blank" href="{{store url="rss"}}"><img src="{{skin url="images/media/blog.jpg"}}" alt="Blog" /></a>
        <a target="_blank" href="https://twitter.com/prointeractive_"><img src="{{skin url="images/media/twitter.jpg"}}" alt="Twitter" /></a>
    </span>
</div>
HTML;

    $cmsBlocksToCreateData = array(
        array(
            'title'      => 'Footer - Liens sociaux',
            'identifier' => $blockIdentifier4,
            'content'    => $blockContent4,
            'is_active'  => true,
            'stores'     => array(Mage_Core_Model_App::ADMIN_STORE_ID)
        )
    );

    /* @var $cmsBlockModel Mage_Cms_Model_Block */
    $cmsBlockModel = Mage::getModel('cms/block');

    foreach ($cmsBlocksToCreateData as $data) {
        $cmsBlock = clone $cmsBlockModel;
        $cmsBlock->load($data['identifier'], 'identifier');

        // Create CMS block if it doesn't exist
        if (!$cmsBlock->getId()) {
            $cmsBlock->setData($data);

            // Otherwise, we update it
        } else {
            // Update all array data
            $cmsBlock->addData($data);
        }

        $cmsBlock->save();
    }

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}