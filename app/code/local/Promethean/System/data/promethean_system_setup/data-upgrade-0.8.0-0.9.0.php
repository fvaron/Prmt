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

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

/**
 * Remove foreign key checks during update
 */
$installer->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');

/**
 * remove existing taxes
 */
$taxTables = array(
    'tax/tax_calculation',
    'tax/tax_class',
    'tax/tax_calculation_rate',
    'tax/tax_calculation_rule',
);
foreach ($taxTables as $taxTable) {
    $installer->getConnection()->truncateTable($installer->getTable($taxTable));
}

/**
 * install tax classes
 */
$taxClasses = array(
    'product_20' =>
        array(
            'class_id' => 2,
            'class_name' => 'Biens et services soumis à la TVA à 20%',
            'class_type' => Mage_Tax_Model_Class::TAX_CLASS_TYPE_PRODUCT
        ),
    'customer_user' =>
        array(
            'class_id' => 3,
            'class_name' => 'Particuliers',
            'class_type' => Mage_Tax_Model_Class::TAX_CLASS_TYPE_CUSTOMER
        ),
    'product_10' =>
        array(
            'class_id' => 4,
            'class_name' => 'Biens et services soumis à la TVA à 10%',
            'class_type' => Mage_Tax_Model_Class::TAX_CLASS_TYPE_PRODUCT
        ),
    'product_5.5' =>
        array(
            'class_id' => 5,
            'class_name' => 'Biens et services soumis à la TVA à 5,5%',
            'class_type' => Mage_Tax_Model_Class::TAX_CLASS_TYPE_PRODUCT
        ),
);
foreach ($taxClasses as $row) {
    $installer->getConnection()->insertForce($installer->getTable('tax/tax_class'), $row);
}

/**
 * install tax calculation rules
 */
$taxRules = array(
    array(
        'tax_calculation_rule_id' => 1,
        'code' => 'Particuliers - CE - 20%',
        'priority' => 1,
        'position' => 1,
        'rate' => '20' // for installer use, not used in DB
    ),
    array(
        'tax_calculation_rule_id' => 2,
        'code' => 'Particuliers - CE - 10%',
        'priority' => 2,
        'position' => 2,
        'rate' => '10' // for installer use, not used in DB
    ),
    array(
        'tax_calculation_rule_id' => 3,
        'code' => 'Particuliers - CE - 5,5%',
        'priority' => 3,
        'position' => 3,
        'rate' => '5.5' // for installer use, not used in DB
    )
);

foreach ($taxRules as $taxRule) {
    unset($taxRule['rate']); // To avoid Column not found: 1054 Unknown column 'rate' in 'field list' error when inserting in DB
    $installer->getConnection()->insertForce($installer->getTable('tax/tax_calculation_rule'), $taxRule);
}

/**
 * install tax calculation rates and calculation
 */
$euCountries = explode(',', Mage::getConfig()->getNode('default/general/country/eu_countries')->asArray());
$countries = Mage::getModel('directory/country')->getCollection()
    ->addFieldToFilter('country_id', array('in' => $euCountries))
    ->toOptionArray(false);

$taxRateId = 0;
foreach ($countries as $k => $country) {
    foreach ($taxRules as $taxRule) {
        $taxRateId++;
        $rate = array(
            'tax_calculation_rate_id' => $taxRateId,
            'tax_country_id' => $country['value'],
            'tax_region_id' => '*',
            'tax_postcode' => '*',
            'code' => $country['value'] . " - {$taxRule['rate']}%",
            'rate' => $taxRule['rate']
        );

        $installer->getConnection()->insertForce($installer->getTable('tax/tax_calculation_rate'), $rate);

        $calculation = array(
            'tax_calculation_rate_id' => $taxRateId,
            'tax_calculation_rule_id' => $taxRule['tax_calculation_rule_id'],
            'customer_tax_class_id' => 3,
            'product_tax_class_id' => $taxClasses['product_' . $taxRule['rate']]['class_id']
        );

        $installer->getConnection()->insertForce($installer->getTable('tax/tax_calculation'), $calculation);
    }
}

/**
 * Reactivate foreign key checks
 */
$installer->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');