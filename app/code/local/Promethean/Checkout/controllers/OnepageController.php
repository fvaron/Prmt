<?php
/**
 * Created by PhpStorm.
 * User: caroline
 * Date: 08/02/16
 * Time: 16:31
 */
require_once 'Mage/Checkout/controllers/OnepageController.php';


class Promethean_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
    /**
     * OVERRIDE
     * Save payment ajax action
     *
     * Sets either redirect or a JSON response
     */
    public function savePaymentAction()
    {
        if ($this->_expireAjax()) {
            return;
        }

        try {
            if (!$this->getRequest()->isPost()) {
                $this->_ajaxRedirectResponse();
                return;
            }

            /**
             * Set payment to quote
             */
            $result = array();
            $data = $this->getRequest()->getPost('payment', array());
            $result = $this->getOnepage()->savePayment($data);

            /**
             * Get section and redirect data
             */
            $redirectUrl = $this->getOnepage()->getQuote()->getPayment()->getCheckoutRedirectUrl();
            if (empty($result['error']) && !$redirectUrl) {
                $result['goto_section'] = 'payment';
                $result['update_section'] = array(
                    'name' => 'payment-method',
                    'html' => $this->_getPaymentMethodsHtml()
                );
            }
            if ($redirectUrl) {
                $result['redirect'] = $redirectUrl;
            }
        } catch (Mage_Payment_Exception $e) {
            if ($e->getFields()) {
                $result['fields'] = $e->getFields();
            }
            $result['error'] = $e->getMessage();
        } catch (Mage_Core_Exception $e) {
            $result['error'] = $e->getMessage();
        } catch (Exception $e) {
            Mage::logException($e);
            $result['error'] = $this->__('Unable to set Payment Method.');
        }

        if (!empty($result['error'])) {
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        } else if (!$this->getFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH)) {
            /**
             * If there is no error for payment save, we try to save the order
             */
            $this->getOnepage()->getQuote()->save();

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
}