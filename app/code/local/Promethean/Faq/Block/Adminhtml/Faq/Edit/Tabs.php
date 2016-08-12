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
class Promethean_Faq_Block_Adminhtml_Faq_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('faq_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('faq')->__('Faq'));
    }

    /**
     * Before HTML
     *
     * @return Mage_Core_Block_Abstract
     *
     * @throws Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('faq')->__('General'),
            'title' => Mage::helper('faq')->__('General'),
            'content' => $this->getLayout()->createBlock('faq/adminhtml_faq_edit_tab_form')->toHtml()
        ));
        return parent::_beforeToHtml();
    }
}