<?php
class ITwebexperts_Request4quote_Model_Resource_Quote_Address_Rate extends Mage_Sales_Model_Resource_Quote_Address_Rate {
	
	protected function _construct()
    {
        $this->_init('request4quote/quote_address_shipping_rate', 'rate_id');
    }
	
}