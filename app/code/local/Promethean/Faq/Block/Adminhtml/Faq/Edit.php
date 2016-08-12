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
class Promethean_Faq_Block_Adminhtml_Faq_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'faq';
        $this->_controller = 'adminhtml_faq';

        $this->_updateButton('save', 'label', Mage::helper('faq')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('faq')->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('recrutement_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'recrutement_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'recrutement_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('faq_data') && Mage::registry('faq_data')->getId()) {
            return Mage::helper('faq')->__('Edit');
        } else {
            return Mage::helper('faq')->__('Add');
        }
    }

    /**
     * Get header CSS class
     *
     * @return string
     */
    public function getHeaderCssClass()
    {
        $headerCss = parent::getHeaderCssClass();
        return $headerCss . ' head-cms-block';
    }
}