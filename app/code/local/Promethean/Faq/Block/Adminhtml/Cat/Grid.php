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
class Promethean_Faq_Block_Adminhtml_Cat_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('catGrid');
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
        $collection = Mage::getModel('faq/cat')->getCollection();
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

        $this->addColumn('name', array(
            'header' => Mage::helper('faq')->__('Theme'),
            'index' => 'name',
            'sortable' => true,
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn(
                'store_id',
                array(
                    'header' => Mage::helper('adminhtml')->__('Visible In'),
                    'type' => 'store',
                    'index' => 'store_id',
                    'sortable' => false,
                    'store_all' => true,
                    'store_view' => true,
                    'width' => 200,
                    'filter_condition_callback' => array($this, '_filterStoreCondition'),
                )
            );
        }

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

        return parent::_prepareColumns();
    }

    /**
     * Collection afterLoad
     *
     * @return $this|void
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    /**
     * Store filter condition callback
     *
     * @param $collection
     * @param $column
     */
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }

    /**
     * Get row Url
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