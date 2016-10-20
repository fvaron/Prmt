<?php
/**
 * This file is part of Promethean_News for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_News
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

/**
 * News Block
 * @package Promethean_News
 */
class Promethean_News_Block_Rewrite_News extends CommerceLab_News_Block_News
{
    /**
     * @rewrite
     * @return object
     */
    public function getNewsItems()
    {
        $collection = Mage::getModel('clnews/news')->getCollection();

        $category = $this->getCategoryKey();
        if ($category!=null) {
            $catCollection = Mage::getModel('clnews/category')->getCollection()
                ->addFieldToFilter('url_key', $category)
                ->addStoreFilter(Mage::app()->getStore()->getId());
            $categoryId = $catCollection->getData();
            if ($categoryId[0]['category_id']) {
                $tableName = Mage::getSingleton('core/resource')->getTableName('clnews_news_category');
                $collection->getSelect()->join($tableName, 'main_table.news_id = ' . $tableName . '.news_id','category_id');
                $collection->getSelect()->where($tableName . '.category_id =?', $categoryId[0]['category_id']);
            }
        } else {
            $collection->addStoreFilter(Mage::app()->getStore()->getId());
        }
        if ($tag = $this->getRequest()->getParam('q')) {
            $collection = Mage::getModel('clnews/news')->getCollection()->setOrder('news_time', 'desc');
            if (count(Mage::app()->getStores()) > 1) {
                $tableName = Mage::getSingleton('core/resource')->getTableName('clnews_news_store');
                $collection->getSelect()->join($tableName, 'main_table.news_id = ' . $tableName . '.news_id','store_id');
                $collection->getSelect()->where('('. $tableName . '.store_id = '. Mage::app()->getStore()->getId(). ' OR store_id = 0)');
            }
            $tag = urldecode($tag);
            $collection->getSelect()->where("tags LIKE '%". $tag . "%'");
        }

        $collection
            ->addEnableFilter(1)
            ->addFieldToFilter('publicate_from_time', array('or' => array(
                0 => array('date' => true, 'to' => date('Y-m-d H:i:s')),
                1 => array('is' => new Zend_Db_Expr('null'))),
            ), 'left')
            ->addFieldToFilter('publicate_to_time', array('or' => array(
                0 => array('date' => true, 'from' => date('Y-m-d H:i:s')),
                1 => array('is' => new Zend_Db_Expr('null'))),
            ), 'left')
            ->setOrder('news_time ', 'desc');
        if ($this->_itemsLimit!=null && $this->_itemsLimit<$collection->getSize()) {
            $this->_pagesCount = ceil($this->_itemsLimit/$this->_itemsOnPage);
        } else {
            $this->_pagesCount = ceil($collection->getSize()/$this->_itemsOnPage);
        }
        for ($i=1; $i<=$this->_pagesCount;$i++) {
            $this->_pages[] = $i;
        }
        $this->setLastPageNum($this->_pagesCount);
        $offset = $this->_itemsOnPage*($this->_currentPage-1);
        if ($this->_itemsLimit!=null) {
            $_itemsCurrentPage = $this->_itemsLimit - $offset;
            if ($_itemsCurrentPage > $this->_itemsOnPage) {
                $_itemsCurrentPage = $this->_itemsOnPage;
            }
            $collection->getSelect()->limit($_itemsCurrentPage, $offset);
        } else {
            $collection->getSelect()->limit($this->_itemsOnPage, $offset);
        }
        foreach ($collection as $item) {
            $comments = Mage::getModel('clnews/comment')->getCollection()
                ->addNewsFilter($item->getNewsId())
                ->addApproveFilter(CommerceLab_News_Helper_Data::APPROVED_STATUS);
            $item->setCommentsCount(count($comments));
        }
        return $collection;
    }
}