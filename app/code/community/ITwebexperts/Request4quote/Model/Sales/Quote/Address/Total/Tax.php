<?php
class ITwebexperts_Request4quote_Model_Sales_Quote_Address_Total_Tax extends Mage_Sales_Model_Quote_Address_Total_Tax
{

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
		if(method_exists($address->getQuote(), 'isR4q') && $address->getQuote()->isR4q()) {
			$applied = $address->getAppliedTaxes();
			$store = $address->getQuote()->getStore();
			$amount = $address->getTaxAmount();
			if (Mage::helper('request4quote')->isTaxEstimatesEnabled() == true) {
				$address->addTotal(array(
					'code' => $this->getCode(),
					'title' => Mage::helper('sales')->__('Tax'),
					'full_info' => $applied ? $applied : array(),
					'value' => $amount
				));
			}
		}else{
			parent::fetch($address);
		}
        return $this;
    }
}
