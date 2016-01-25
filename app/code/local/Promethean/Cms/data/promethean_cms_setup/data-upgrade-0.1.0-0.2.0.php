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
    $blockIdentifier2 = "footer-links-cat";
    $blockContent2 = <<<HTML
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="activboard.html"}}">Activboard</a>
    <ul>
        <li><a href="{{store url="activboard.html"}}">Touch</a></li>
        <li><a href="{{store url="activboard.html"}}">500 Pro</a></li>
        <li><a href="{{store url="activboard.html"}}">300 Pro</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="activpanel.html"}}">Activpanel</a>
    <ul>
        <li><a href="{{store url="catalog/product/view/id/22/s/activpanel-55/category/3/"}}">55 pouces</a></li>
        <li><a href="{{store url="activpanel/activpanel-65-pouces.html"}}">65 pouces</a></li>
        <li><a href="{{store url="activpanel/activpanel-70-pouces.html"}}">70 pouces</a></li>
        <li><a href="{{store url="activpanel/activpanel-84-pouces.html"}}">84 pouces</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="actiview.html"}}">Actiview</a>
    <ul>
        <li><a href="{{store url="actiview/actiview-324.html"}}">ActiView 324</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="activinspire.html"}}">Activinspire</a>
    <ul>
        <li><a href="{{store url="activinspire/activinspire-professional-edition.html"}}">Professional Edition</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="boitiers.html"}}">Boitiers</a>
    <ul>
        <li><a href="{{store url="boitiers/activote.html"}}">ActiVote</a></li>
        <li><a href="{{store url="boitiers/activexpression.html"}}">ActivExpression 2</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="lampes.html"}}">Accessoires</a>
    <ul>
        <li><a href="{{store url="lampes.html"}}">Stylets</a></li>
        <li><a href="{{store url="lampes.html"}}">Mine de stylets</a></li>
        <li><a href="{{store url="lampes.html"}}">Lampes</a></li>
        <li><a href="{{store url="lampes.html"}}">Filtres</a></li>
        <li><a href="{{store url="lampes.html"}}">Autres produits</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <a class="title-footer-menu" href="{{store url="services.html"}}">Services</a>
    <ul>
        <li><a href="{{store url="services.html"}}">Formations</a></li>
        <li><a href="{{store url="services.html"}}">Forfaits d'installation</a></li>
    </ul>
</div>
HTML;

    $blockIdentifier4 = "footer-sociaux";
    $blockContent4 = <<<HTML
<div class="footer-sociaux">
    <span class="title-footer-menu">Suivez nous</span>
    <span class="link">
        <a href="http://www.youtube.com/c/PrometheanFrProInteractive"><img src="{{skin url="images/media/youtube.jpg"}}" alt="Youtube" /></a>
        <a href="https://plus.google.com/+PrometheanFrProInteractive"><img src="{{skin url="images/media/google.jpg"}}" alt="Google +" /></a>
        <a href="#"><img src="{{skin url="images/media/blog.jpg"}}" alt="Blog" /></a>
        <a href="https://twitter.com/promethean_fr"><img src="{{skin url="images/media/twitter.jpg"}}" alt="Twitter" /></a>
    </span>
</div>
HTML;

    $blockIdentifier5 = "footer-payment";
    $blockContent5 = <<<HTML
<div class="footer-payment">
    <span class="title-footer-menu">Paiement sécurisé</span>
    <div class="method-payment">
        <a href="{{store url="paiement-securise"}}">
            <img src="{{skin url="images/media/gopay.jpg"}}" alt="Go Pay" /><img src="{{skin url="images/media/visa.jpg"}}" alt="Visa" /><img src="{{skin url="images/media/mastercard.jpg"}}" alt="Mastercard" /><img src="{{skin url="images/media/paypal.jpg"}}" alt="Paypal" />
        </a>
    </div>
    <a href="{{store url="paiement-securise"}}"><img src="{{skin url="images/media/mandat.jpg"}}" alt="Mandat" /></a>
</div>
HTML;

    $cmsBlocksToCreateData = array(
        array(
            'title'      => 'Footer - Liens catégories',
            'identifier' => $blockIdentifier2,
            'content'    => $blockContent2,
            'is_active'  => true,
            'stores'     => array(Mage_Core_Model_App::ADMIN_STORE_ID)
        ),
        array(
            'title'      => 'Footer - Liens sociaux',
            'identifier' => $blockIdentifier4,
            'content'    => $blockContent4,
            'is_active'  => true,
            'stores'     => array(Mage_Core_Model_App::ADMIN_STORE_ID)
        ),
        array(
            'title'      => 'Footer - Paiement sécurisé',
            'identifier' => $blockIdentifier5,
            'content'    => $blockContent5,
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