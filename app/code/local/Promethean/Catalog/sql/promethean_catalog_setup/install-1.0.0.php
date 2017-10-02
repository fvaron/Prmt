<?php
/**
 * This file is part of Promethean_Catalog for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Catalog
 * @copyright Copyright (c) 2017 Caroline Framery (http://)
 */

try {

    /* @var $conn Varien_Db_Adapter_Interface */
    /* @var $installer Mage_Catalog_Model_Resource_Setup */
    $installer = $this;
    $installer->startSetup();

    // Add attribute google shopping product
    $installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'prome_googleshopping', array(
        'label'                      => 'Présent dans google shopping', // Default label
        'group'                      => 'General',
        'input'                      => 'boolean', // Input type (text, textarea, select...)
        'type'                       => 'int', // Attribute type (varchar, text, int, decimal...)
        'required'                   => false, // Is the attribute mandatory?
        'comparable'                 => false, // Is the attribute comparable? (on frontend).
        'filterable'                 => false, // Is the attribute filterable? (on frontend, in category view)
        'filterable_in_search'       => false, // Is the attribute filterable? (on frontend, in search view)
        'used_for_promo_rules'       => false, // Do we need that attribute for specific promo rules?
        'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL, // Attribute scope
        'is_configurable'            => false, // Can the attribute be used to create configurable products?
        'is_html_allowed_on_front'   => false, // Is HTML allowed on frontend?
        'note'                       => '', // Note below the input field on admin area
        'searchable'                 => false, // Is the attribute searchable?
        'sort_order'                 => 0, // Which position on the admin area form group?
        'unique'                     => false, // Must attribute values be unique?
        'used_for_sort_by'           => false, // Can attribute be used for 'sort by' select on catalog/search views?
        'used_in_product_listing'    => true, // Should we flat this attribute?
        'user_defined'               => true,
        // Is the attribute user defined? If false the attribute isn't removable. TRUE needed if configurable attribute.
        'visible'                    => true, // Is attribute visible? If true the field appears in admin product page.
        'visible_on_front'           => false, // Is attribute visible on front?
        'visible_in_advanced_search' => false, // Is the attribute visible on advanced search?
        'wysiwyg_enabled'            => false, // Is Wysiwyg enabled?
        'apply_to'                   => Mage_Catalog_Model_Product_Type::TYPE_SIMPLE . ',' . Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE, // Product types
    ));

    $attributeSetsName = array(
        'Default',
        'Dimension',
    );

    foreach ($attributeSetsName as $attributeSetName) {
        $installer->addAttributeToSet(
            Mage_Catalog_Model_Product::ENTITY,   // Entity type
            $attributeSetName,                            // Attribute set name
            "General",                            // Attribute set group name
            'prome_googleshopping',                               // Attribute code to add
            10                                   // Position on the attribute set group
        );
    }
    $installer->endSetup();

} catch (Exception $e) {
    // Silence is golden
    Mage::log($e, null, 'local.log', true);
    Mage::logException($e);
    if (Mage::getIsDeveloperMode()) {
        Mage::throwException($e->getMessage());
    }
}