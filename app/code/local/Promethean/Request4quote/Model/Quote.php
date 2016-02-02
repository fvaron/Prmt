<?php
/**
 * Created by PhpStorm.
 * User: caroline
 * Date: 02/02/16
 * Time: 23:28
 */ 
class Promethean_Request4quote_Model_Quote extends ITwebexperts_Request4quote_Model_Quote
{
    /**
     * Get formated quote created date in store timezone
     *
     * @return  string
     */
    public function getCreatedAtFormated()
    {
        $timestamp = Mage::getModel('core/date')->timestamp(strtotime($this->getCreatedAt()));
        return date('d/m/Y', $timestamp);
    }

    public function getValideDate()
    {
        $timestamp = Mage::getModel('core/date')->timestamp(strtotime($this->getCreatedAt() . ' + 7 days'));
        return date('d/m/Y', $timestamp);
    }
}