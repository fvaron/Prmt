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
class Promethean_Faq_Block_Adminhtml_Faq_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('faqGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('faq/faq')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return $this
     *
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('faq')->__('Id'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'id',
            'sortable' => true,
        ));

        $this->addColumn('question', array(
            'header' => Mage::helper('faq')->__('Question'),
            'index' => 'question',
            'sortable' => true,
        ));

        $this->addColumn('is_active', array(
            'header' => Mage::helper('faq')->__('Status'),
            'index' => 'is_active',
            'width' => '100px',
            'sortable' => true,
            'type' => 'options',
            'options' => array(
                '1' => 'Active',
                '0' => 'Inactive',
            ),
            'frame_callback' => array($this, 'decorateStatus')
        ));

        $this->addColumn('is_most_frequently_asked', array(
            'header' => Mage::helper('faq')->__('Is Most Frequently Asked Question?'),
            'index' => 'is_most_frequently_asked',
            'width' => '100px',
            'sortable' => true,
            'type' => 'options',
            'options' => array(
                '1' => Mage::helper('faq')->__('Yes'),
                '0' => Mage::helper('faq')->__('No'),
            )
        ));

        return parent::_prepareColumns();
    }

    /**
     * Get row url
     *
     * @param $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Decorate status column values
     *
     * @param $value
     * @param $row
     * @param $column
     * @param $isExport
     *
     * @return string
     */
    public function decorateStatus($value, $row, $column, $isExport)
    {
        if ((bool)$row->getIsActive()) {
            $class = 'grid-severity-notice';
        } else {
            $class = 'grid-severity-critical';
        }
        return '<span class="' . $class . '"><span>' . $value . '</span></span>';
    }
}