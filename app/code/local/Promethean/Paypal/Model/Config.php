<?php
/**
 * This file is part of Promethean_Paypal for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Paypal
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */ 
class Promethean_Paypal_Model_Config extends Mage_Paypal_Model_Config
{
    /**
     * OVERRIDE
     * Get url for dispatching customer to express checkout start
     *
     * @param string $token
     * @return string
     */
    public function getExpressCheckoutStartUrl($token)
    {
        return $this->getPaypalUrl(array(
            'cmd'   => '_express-checkout',
            'useraction'    => 'commit',
            'token' => $token,
        ));
    }
}