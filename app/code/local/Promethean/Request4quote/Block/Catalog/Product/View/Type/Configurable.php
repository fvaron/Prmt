<?php
/**
 * This file is part of Promethean_Request4quote for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Request4quote
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Request4quote_Block_Catalog_Product_View_Type_Configurable extends ITwebexperts_Request4quote_Block_Catalog_Product_View_Type_Configurable
{
    /**
     * OVERRIDE
     * @param Mage_Catalog_Model_Product $product
     * @param bool|false $displayMinimalPrice
     * @param string $idSuffix
     * @return string
     */
    public function getPriceHtml($product, $displayMinimalPrice = false, $idSuffix = '')
    {
        return Mage_Catalog_Block_Product_View_Type_Simple::getPriceHtml($product, $displayMinimalPrice, $idSuffix);
    }
}