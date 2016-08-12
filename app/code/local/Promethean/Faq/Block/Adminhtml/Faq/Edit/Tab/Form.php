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
class Promethean_Faq_Block_Adminhtml_Faq_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('informations', array('legend' => Mage::helper('faq')->__('Details')));
        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array(
            'add_variables' => false,
            'add_widgets' => false,
            'add_images' => false,
            'hidden' => true,
        ));

        $fieldset->addField('cat_id', 'select', array(
            'label' => Mage::helper('faq')->__('Theme'),
            'name' => 'cat_id',
            'required' => true,
            'values' => Mage::getModel('faq/cat')->getCollection()
                ->addActiveFilter()
                ->toOptionArray(),
        ));

        $fieldset->addField('question', 'text', array(
            'label' => Mage::helper('faq')->__('Question'),
            'name' => 'question',
            'required' => true,
        ));

        $fieldset->addField('response', 'editor', array(
            'label' => Mage::helper('faq')->__('Answer'),
            'name' => 'response',
            'config' => $wysiwygConfig,
            'wysiwyg' => true,
            'required' => true,
        ));

        $fieldset->addField('is_active', 'select', array(
            'label' => Mage::helper('faq')->__('Status'),
            'name' => 'is_active',
            'values' => array(
                0 => $this->__('Inactive'),
                1 => $this->__('Active')
            )
        ));

        $fieldset->addField('is_most_frequently_asked', 'select', array(
            'label' => Mage::helper('faq')->__('Is Most Frequently Asked Question?'),
            'name' => 'is_most_frequently_asked',
            'values' => array(
                0 => Mage::helper('adminhtml')->__('No'),
                1 => Mage::helper('adminhtml')->__('Yes'),
            )
        ));

        if (Mage::getSingleton('adminhtml/session')->getFaqData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getFaqData());
            Mage::getSingleton('adminhtml/session')->setFaqData(null);
        } elseif (Mage::registry('faq_data')) {
            $form->setValues(Mage::registry('faq_data')->getData());
        }

        return parent::_prepareForm();
    }
}