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
class Promethean_Checkout_Block_Onepage extends Mage_Checkout_Block_Onepage
{
    /**
     * OVERRIDE
     * Get 'one step checkout' step data
     *
     * @return array
     */
    public function getSteps()
    {
        $steps = array();
        $stepCodes = array('login', 'billing', 'shipping', 'shipping_method', 'payment');

        if ($this->isCustomerLoggedIn()) {
            $stepCodes = array_diff($stepCodes, array('login'));
        }

        foreach ($stepCodes as $step) {
            $steps[$step] = $this->getCheckout()->getStepData($step);
        }

        return $steps;
    }
}