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

    /* Configuration modes de paiement */
    $installer->setConfigData('payment/checkmo/title', 'Paiement par chèque');
    $installer->setConfigData('payment/checkmo/payable_to', 'TSR INFORMATIQUE');
    $installer->setConfigData('payment/checkmo/mailing_address', 'PROINTERACTIVE 
40, rue Baudin
92400 COURBEVOIE
France');
    $installer->setConfigData('payment/ccsave/active', 0);
    $installer->setConfigData('payment/banktransfer/active', 1);
    $installer->setConfigData('payment/banktransfer/title', 'Paiement par virement bancaire / Mandat Administratif');
    $installer->setConfigData('payment/banktransfer/instructions', 'IBAN : FR76 1020 7002 0321 2156 2109 178
BIC : CCBPFRPPMTG');


    $installer->setConfigData('checkout/options/enable_agreements', 1);

    $installer->setConfigData('payment/paypal_express/active', 1);
    $installer->setConfigData('paypal/general/business_account', 'fvaron@tsr-informatique.fr');
    $installer->setConfigData('paypal/wpp/api_username', Mage::helper('core')->encrypt('fvaron_api1.tsr-informatique.fr'));
    $installer->setConfigData('paypal/wpp/api_password', Mage::helper('core')->encrypt('PDNQHBJV48XBLEAT'));
    $installer->setConfigData('paypal/wpp/api_signature', Mage::helper('core')->encrypt('ALdwyOoQG13ZVIp-TDXdKEAkBNMIA8dzNlq-EF0UNT7uxyAKZwHyafoa'));
    $installer->setConfigData('payment/paypal_billing_agreement/active', 0);
    $installer->setConfigData('payment/paypal_express/title', 'Paiement sécurisé Visa / Mastercard / Paypal');
    $installer->setConfigData('payment/paypal_express/payment_action', 'Sale');
    $installer->setConfigData('payment/paypal_express/visible_on_product', 0);
    $installer->setConfigData('payment/paypal_express/visible_on_cart', 0);
    $installer->setConfigData('payment/paypal_express/debug', 1);
    $installer->setConfigData('payment/paypal_express//verify_peer', 0);
    $installer->setConfigData('payment/paypal_express/skip_order_review_step', 0);


    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
}
