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
class Promethean_Faq_Adminhtml_Faq_FaqController extends Mage_Adminhtml_Controller_action
{
    /**
     * Init action
     *
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('cms/faq')
            ->_addBreadcrumb(Mage::helper('faq')->__('Questions Manager'),
                Mage::helper('adminhtml')->__('Questions Manager'));
        return $this;
    }

    /**
     * Grid
     */
    public function indexAction()
    {
        $this->_initAction();
        $this->_title($this->__('FAQ'))->_title($this->__('Questions Manager'));
        $this->renderLayout();
    }

    /**
     * Edit action
     */
    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('faq/faq')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('faq_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('faq/items');

            $this->_title($this->__('FAQ'))->_title($this->__('Edit Question'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Questions Manager'),
                Mage::helper('adminhtml')->__('Questions Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Questions Manager'),
                Mage::helper('adminhtml')->__('Questions Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
                $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }

            $this->_addContent($this->getLayout()->createBlock('faq/adminhtml_faq_edit'))
                ->_addLeft($this->getLayout()->createBlock('faq/adminhtml_faq_edit_tabs'));;

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('faq')->__('Question does not exist'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * New question
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Save question
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('faq/faq');
            if (!$this->getRequest()->getParam('id')) {
                $collection = $model->getCollection()->addFieldToSelect('id');
                $sort_order = count($collection) + 1;
                $data['sort'] = $sort_order;
            }
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('faq')->__('Question has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('faq')->__('Unable to find a question to save'));
        $this->_redirect('*/*/');
    }

    /**
     * Delete question
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('faq/faq');
                $model->load($id);
                $model->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('faq')->__('Question has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('faq')->__('Unable to delete question.'));
        $this->_redirect('*/*/');
    }
}