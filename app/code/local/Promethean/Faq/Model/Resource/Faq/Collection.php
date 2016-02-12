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
class Promethean_Faq_Model_Resource_Faq_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Constructor
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('faq/faq');
    }

    /**
     * Add active filter
     *
     * @param bool $active
     *
     * @return Promethean_Faq_Model_Resource_Faq_Collection
     */
    public function addActiveFilter($active = true)
    {
        $this->addFieldToFilter('is_active', $active);
        return $this;
    }

    /**
     * Add most frequently asked questions filter
     *
     * @return Promethean_Faq_Model_Resource_Faq_Collection
     */
    public function addFrequentlyAskedFilter()
    {
        $this->addFieldToFilter('is_most_frequently_asked', true);
        return $this;
    }

    /**
     * Add most frequently asked questions filter
     *
     * @param array $categoryIds
     *
     * @return Promethean_Faq_Model_Resource_Faq_Collection
     */
    public function addCategoryFilter($categoryIds = array())
    {
        $this->addFieldToFilter('cat_id', array('in' => $categoryIds));
        return $this;
    }
}