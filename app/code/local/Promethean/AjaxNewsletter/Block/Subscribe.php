<?php
/**
 * This file is part of Promethean_AjaxNewsletter for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_AjaxNewsletter
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_AjaxNewsletter_Block_Subscribe extends Mage_Newsletter_Block_Subscribe
{
    /**
     * OVERRIDE in order to use secure url only when necessary
     * (and so, prevent cross domain ajax request issues)
     *
     * Retrieve form action url and set "secure" param to avoid confirm
     * message when we submit form from secure page to unsecure
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('newsletter/subscriber/new', array('_secure' => Mage::app()->getStore()->isCurrentlySecure()));
    }
}