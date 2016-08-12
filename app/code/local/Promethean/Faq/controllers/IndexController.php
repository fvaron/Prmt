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
class Promethean_Faq_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     * (listing)
     */
    public function indexAction()
    {
        $this->loadLayout();

        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $headBlock->setTitle($this->__('F.A.Q'));
        }

        $this->renderLayout();
    }
}