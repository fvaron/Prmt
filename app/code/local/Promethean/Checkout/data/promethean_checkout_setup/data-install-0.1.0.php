<?php
/**
 * This file is part of Promethean_Checkout for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Checkout
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

$installer = $this;
$installer->startSetup();

// agreement
$content = <<<HTML
J'accepte les <a href="/conditions-generales-de-vente" target="_blank">conditions générales de vente</a>
HTML;

$data = array(
    'name' => 'Conditions générales de vente',
    'is_active' => '1',
    'is_html' => '1',
    'stores' => array(0 => '1'),
    'checkbox_text' => $content,
    'content' => '&nbsp;',
    'content_height' => '',
);

$model = Mage::getSingleton('checkout/agreement');
$model->setData($data)->save();


$installer->endSetup();
