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
class Promethean_News_Block_Rewrite_Newsitem extends CommerceLab_News_Block_Newsitem
{
    /**
     * @override
     * @return string
     */
    protected function _toHtml()
    {
        $html = Mage_Core_Block_Template::_toHtml();
        return $html;
    }

    /**
     * Get collection news in array
     * @return mixed
     */
    public function getcollection()
    {
        $collection = Mage::getModel('clnews/news')->getCollection()
            ->addEnableFilter(1)
            ->toArray();
        return $collection['items'];
    }

    /**
     * Get key to current news
     * @param $itemId
     * @return bool|int|string
     */
    public function getKeyBycollection($itemId)
    {
        $collection = $this->getcollection();
        foreach($collection as $key => $news)
        {
            if($news['news_id'] == $itemId)
            {
                return $key;
            }
        }
        return false;
    }

    /**
     * Get previous news
     * @return bool|Mage_Core_Model_Abstract
     */
    public function getPreviousNews()
    {
        $collection = $this->getcollection();
        $itemIdKey = $this->getKeyBycollection($this->getNewsItem()->getId());
        if(isset($collection[$itemIdKey-1])) {
            $previousNewsId = $collection[$itemIdKey-1];
            $previousNews = Mage::getModel('clnews/news')->load($previousNewsId['news_id']);
            if($previousNews && $previousNews instanceof CommerceLab_News_Model_News) {
                return $previousNews;
            }
        }
        return false;
    }

    /**
     * Get next news
     * @return bool|Mage_Core_Model_Abstract
     */
    public function getNextNews()
    {
        $collection = $this->getcollection();
        $itemIdKey = $this->getKeyBycollection($this->getNewsItem()->getId());	
        if(isset($collection[$itemIdKey+1])) {
            $nextNewsId = $collection[$itemIdKey+1];
            $nextNews = Mage::getModel('clnews/news')->load($nextNewsId['news_id']);
            if($nextNews && $nextNews instanceof CommerceLab_News_Model_News) {
                return $nextNews;
            }
        }
        return false;
    }
}
