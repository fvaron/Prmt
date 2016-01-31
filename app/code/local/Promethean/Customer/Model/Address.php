<?php
/**
 * This file is part of Promethean_Customer for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Customer
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Customer_Model_Address extends Mage_Customer_Model_Address
{
    /**
     * OVERRIDE
     * Perform basic validation
     *
     * @return void
     */
    protected function _basicCheck()
    {
        if (!Zend_Validate::is($this->getFirstname(), 'NotEmpty')) {
            $this->addError(Mage::helper('customer')->__('Please enter the first name.'));
        }

        if (!Zend_Validate::is($this->getLastname(), 'NotEmpty')) {
            $this->addError(Mage::helper('customer')->__('Please enter the last name.'));
        }

        if (!Zend_Validate::is($this->getStreet(1), 'NotEmpty')) {
            $this->addError(Mage::helper('customer')->__('Please enter the street.'));
        }

        if (!Zend_Validate::is($this->getCity(), 'NotEmpty')) {
            $this->addError(Mage::helper('customer')->__('Please enter the city.'));
        }

        if (!Zend_Validate::is($this->getTelephone(), 'NotEmpty') && !Zend_Validate::is($this->getMobile(), 'NotEmpty')) {
            $this->addError(Mage::helper('customer')->__('Please enter the telephone number.'));
        }

        $_havingOptionalZip = Mage::helper('directory')->getCountriesWithOptionalZip();
        if (!in_array($this->getCountryId(), $_havingOptionalZip)
            && !Zend_Validate::is($this->getPostcode(), 'NotEmpty')
        ) {
            $this->addError(Mage::helper('customer')->__('Please enter the zip/postal code.'));
        }

        if (!Zend_Validate::is($this->getCountryId(), 'NotEmpty')) {
            $this->addError(Mage::helper('customer')->__('Please enter the country.'));
        }

        if ($this->getCountryModel()->getRegionCollection()->getSize()
            && !Zend_Validate::is($this->getRegionId(), 'NotEmpty')
            && Mage::helper('directory')->isRegionRequired($this->getCountryId())
        ) {
            $this->addError(Mage::helper('customer')->__('Please enter the state/province.'));
        }
    }
}