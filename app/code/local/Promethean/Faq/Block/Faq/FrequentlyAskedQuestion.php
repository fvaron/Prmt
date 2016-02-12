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
class Promethean_Faq_Block_Faq_FrequentlyAskedQuestion extends Promethean_Faq_Block_Faq
{
    /**
     * Get faq items collection
     *
     * @return Promethean_Faq_Model_Resource_Faq_Collection
     */
    protected function _getCollection()
    {
        $collection = parent::_getCollection();

        /**
         * Add most frequently asked filter
         */
        $collection->addFrequentlyAskedFilter();

        /**
         * Add limitation if defined
         */
        if ($limit = $this->getLimit()) {
            $collection->setPageSize($limit);
            $collection->setCurPage(1);
        }

        return $collection;
    }

}