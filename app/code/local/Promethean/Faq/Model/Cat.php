<?php
/**
 * This file is part of Promethean_Faq for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Faq
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Faq_Model_Cat extends Mage_Core_Model_Abstract
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'promethean_faq_cat';

    /**
     * Parameter name in event
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'promethean_faq_cat';

    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('faq/cat');
    }
}