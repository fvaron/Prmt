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

    $blockIdentifier = "footer-links-infos";
    $blockContent = <<<HTML
<div class="footer-row footer-menu2">
    <span class="title-footer-menu">Informations</span>
    <ul>
        <li><a href="{{store url="conditions-generales-de-vente"}}">CGV</a></li>
        <li><a href="{{store url="contact"}}">Contact</a></li>
        <li><a href="{{store url="faq"}}">F.A.Q</a></li>
        <li><a href="{{store url="mentions-legales"}}">Mentions l&eacute;gales</a></li>
        <li><a href="{{store url="paiement-securise"}}">Paiement s&eacute;curis&eacute;</a></li>
        <li><a href="{{store url="qui-sommes-nous"}}">Qui sommes-nous ?</a></li>
        <li><a href="{{store url="Showroom"}}">Showroom</a></li>
        <li><a href="{{store url="actualites"}}">Actualités</a></li>
        <li><a href="{{store url="garanties-et-extensions"}}">Garanties et extensions</a></li>
        <li><a href="{{store url="installation-et-assistance"}}">Installation et assistance</a></li>
        <li><a href="{{store url="formations"}}">Formations</a></li>
    </ul>
</div>
HTML;

    $cmsBlocksToCreateData = array(
        array(
            'title'      => 'Footer - liens informations',
            'identifier' => $blockIdentifier,
            'content'    => $blockContent,
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