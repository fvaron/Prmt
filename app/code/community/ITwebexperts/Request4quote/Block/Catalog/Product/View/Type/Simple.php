<?php
class ITwebexperts_Request4quote_Block_Catalog_Product_View_Type_Simple extends Mage_Catalog_Block_Product_View_Type_Simple
{
    public function getPriceHtml($product, $displayMinimalPrice = false, $idSuffix = '')
    {
        if($product->getR4qEnabled()){
            return '';
        }
        return parent::getPriceHtml($product, $displayMinimalPrice, $idSuffix);
    }
}
