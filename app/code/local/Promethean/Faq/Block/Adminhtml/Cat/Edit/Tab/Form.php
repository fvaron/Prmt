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
class Promethean_Faq_Block_Adminhtml_Cat_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $entity = Mage::registry('faq_cat_data');

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('informations', array('legend' => Mage::helper('faq')->__('Details')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('faq')->__('Theme'),
            'name' => 'name',
            'required' => true,
        ));

        $fieldset->addField('is_active', 'select', array(
            'label' => Mage::helper('faq')->__('Status'),
            'name' => 'is_active',
            'values' => array(
                1 => Mage::helper('faq')->__('Active'),
                0 => Mage::helper('faq')->__('Inactive')
            )
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $field = $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('cms')->__('Store View'),
                'title' => Mage::helper('cms')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId(),
            ));
            $entity->setStoreId(Mage::app()->getStore(true)->getId());
        }

        if (Mage::getSingleton('adminhtml/session')->getFaqCatData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getFaqCatData());
            Mage::getSingleton('adminhtml/session')->setFaqCatData(null);
        } elseif ($entity) {
            $form->setValues($entity->getData());
        }

        return parent::_prepareForm();
    }
}