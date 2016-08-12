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
class Promethean_Faq_Block_Faq extends Mage_Core_Block_Template
{
    /**
     * @var Promethean_Faq_Model_Resource_Cat_Collection
     */
    protected $_categoryCollection;

    /**
     * @var Promethean_Faq_Model_Resource_Faq_Collection
     */
    protected $_itemCollection;

    /**
     * Retrieve faq item array, by category
     *
     * @return array
     */
    public function getItemArrayByCategory()
    {
        $array = array();

        $faqCollection = $this->_getCollection();

        foreach ($faqCollection as $faq) {
            $array[$faq->getCatId()][$faq->getId()] = $faq;
        }

        return $array;
    }

    /**
     * Get faq items collection
     *
     * @return Promethean_Faq_Model_Resource_Faq_Collection
     */
    protected function _getCollection()
    {
        if (is_null($this->_itemCollection)) {
            $categoryCollection = $this->getCategoryCollection();
            $allowedCategoryIds = array();

            /**
             * Build array of allowed category Ids
             */
            foreach ($categoryCollection->toOptionArray() as $category) {
                $allowedCategoryIds[] = $category['value'];
            }

            $this->_itemCollection = Mage::getModel('faq/faq')->getCollection()
                ->addActiveFilter()
                ->addCategoryFilter($allowedCategoryIds)
                ->setOrder('sort', Varien_Data_Collection::SORT_ORDER_ASC);
        }

        return $this->_itemCollection;
    }

    /**
     * Get category collection
     *
     * @return Promethean_Faq_Model_Resource_Cat_Collection
     */
    public function getCategoryCollection()
    {
        if (is_null($this->_categoryCollection)) {
            $this->_categoryCollection = Mage::getModel('faq/cat')
                ->getCollection()
                ->addActiveFilter()
                ->addStoreFilter(Mage::app()->getStore()->getStoreId());
        }

        return $this->_categoryCollection;
    }
}