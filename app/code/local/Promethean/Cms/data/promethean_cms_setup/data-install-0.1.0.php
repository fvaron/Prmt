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

    /* @var $installer Mage_Core_Model_Resource_Setup */
    $installer = $this;

    $blockIdentifier1 = "footer-adresse";
    $blockContent1 = <<<HTML
<div class="footer-1-titre row"><span>Pro</span>Interactive</div>
<div class="footer-1-txt row">
     40, rue Baudin - 92400 COURBEVOIE - FRANCE<br/>
     SARL au capital de 4000 Euros<br/>
     Entreprise enregistrée au RCS de NANTERRE sous le numéro 788 573 475<br/>
</div>
HTML;

    $blockIdentifier2 = "footer-links-cat";
    $blockContent2 = <<<HTML
<div class="footer-menu-item">
    <span class="title-footer-menu">Activboard</span>
    <ul>
        <li><a href="{{store url="#"}}">Touch</a></li>
        <li><a href="{{store url="#"}}">500 Pro</a></li>
        <li><a href="{{store url="#"}}">300 Pro</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <span class="title-footer-menu">Activpanel</span>
    <ul>
        <li><a href="{{store url="#"}}">55 pouces</a></li>
        <li><a href="{{store url="#"}}">65 pouces</a></li>
        <li><a href="{{store url="#"}}">70 pouces</a></li>
        <li><a href="{{store url="#"}}">84 pouces</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <span class="title-footer-menu">Actiview</span>
    <ul>
        <li><a href="{{store url="#"}}">ActiView 324</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <span class="title-footer-menu">Activinspire</span>
    <ul>
        <li><a href="{{store url="#"}}">Professional Edition</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <span class="title-footer-menu">Boitiers</span>
    <ul>
        <li><a href="{{store url="#"}}">ActiVote</a></li>
        <li><a href="{{store url="#"}}">ActivExpression 2</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <span class="title-footer-menu">Accessoires</span>
    <ul>
        <li><a href="{{store url="#"}}">Stylets</a></li>
        <li><a href="{{store url="#"}}">Mine de stylets</a></li>
        <li><a href="{{store url="#"}}">Lampes</a></li>
        <li><a href="{{store url="#"}}">Filtres</a></li>
        <li><a href="{{store url="#"}}">Autres produits</a></li>
    </ul>
</div>
<div class="footer-menu-item">
    <span class="title-footer-menu">Services</span>
    <ul>
        <li><a href="{{store url="#"}}">Formations</a></li>
        <li><a href="{{store url="#"}}">Forfaits d'installation</a></li>
    </ul>
</div>
HTML;

    $blockIdentifier3 = "footer-links-infos";
    $blockContent3 = <<<HTML
<div class="footer-row footer-menu2">
    <span class="title-footer-menu">Informations</span>
    <ul>
        <li><a href="{{store url="conditions-generales-de-vente"}}">CGV</a></li>
        <li><a href="{{store url="contact"}}">Contact</a></li>
        <li><a href="{{store url="faq"}}">F.A.Q</a></li>
        <li><a href="{{store url="mentions-legales"}}">Mentions légales</a></li>
        <li><a href="{{store url="paiement-securise"}}">Paiement sécurisé</a></li>
        <li><a href="{{store url="qui-sommes-nous"}}">Qui sommes-nous ?</a></li>
        <li><a href="{{store url="showroom"}}">Showroom</a></li>
    </ul>
</div>
HTML;

    $blockIdentifier4 = "footer-sociaux";
    $blockContent4 = <<<HTML
<div class="footer-sociaux">
    <span class="title-footer-menu">Suivez nous</span>
    <span class="link">
        <a href="#"><img src="{{skin url="images/media/youtube.jpg"}}" alt="Youtube" /></a>
        <a href="#"><img src="{{skin url="images/media/google.jpg"}}" alt="Google +" /></a>
        <a href="#"><img src="{{skin url="images/media/blog.jpg"}}" alt="Blog" /></a>
        <a href="#"><img src="{{skin url="images/media/twitter.jpg"}}" alt="Twitter" /></a>
    </span>
</div>
HTML;

    $blockIdentifier5 = "footer-payment";
    $blockContent5 = <<<HTML
<div class="footer-payment">
    <span class="title-footer-menu">Paiement sécurisé</span>
    <div class="method-payment">
        <img src="{{skin url="images/media/gopay.jpg"}}" alt="Go Pay" /><img src="{{skin url="images/media/visa.jpg"}}" alt="Visa" /><img src="{{skin url="images/media/mastercard.jpg"}}" alt="Mastercard" /><img src="{{skin url="images/media/paypal.jpg"}}" alt="Paypal" />
    </div>
    <img src="{{skin url="images/media/mandat.jpg"}}" alt="Go Pay" />
</div>
HTML;

    $cmsBlocksToCreateData = array(
        array(
            'title'      => 'Footer - Adresse',
            'identifier' => $blockIdentifier1,
            'content'    => $blockContent1,
            'is_active'  => true,
            'stores'     => array(Mage_Core_Model_App::ADMIN_STORE_ID)
        ),
        array(
            'title'      => 'Footer - Liens catégories',
            'identifier' => $blockIdentifier2,
            'content'    => $blockContent2,
            'is_active'  => true,
            'stores'     => array(Mage_Core_Model_App::ADMIN_STORE_ID)
        ),
        array(
            'title'      => 'Footer - liens informations',
            'identifier' => $blockIdentifier3,
            'content'    => $blockContent3,
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