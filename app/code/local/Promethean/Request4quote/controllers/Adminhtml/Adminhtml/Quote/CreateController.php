<?php
/**
 * Created by PhpStorm.
 * User: cframery
 * Date: 27/06/17
 * Time: 23:28
 */
require_once 'ITwebexperts/Request4quote/controllers/Adminhtml/Quote/CreateController.php';


class Promethean_Request4quote_Adminhtml_Adminhtml_Quote_CreateController extends ITwebexperts_Request4quote_Adminhtml_Quote_CreateController
{
    /**
     * @override
     */
    public function saveAction()
    {
        try {
            $quote = $this->_getQuote();
            if (count($this->_getQuote()->getAllItems())) {
                // Override set date
                $datas = $this->getRequest()->getPost();
                $datas = $this->_filterDates($datas, array('created_at', 'expiration_date'));
                $data = $this->getRequest()->getPost('order');
                $comment = $this->getRequest()->getPost('comment');
                $commentForm = isset($comment['comment']) ? $comment['comment'] : '';
                $accountData = $data['account'];
                $status = $this->getRequest()->getPost('r4q_status');
                $appendComments = isset($data['comment']['customer_note_notify']) ? $data['comment']['customer_note_notify'] : '';
                $visibleFront = isset($comment['is_visible_on_front']) ? $comment['is_visible_on_front'] : '';
                $notifyCustomer = isset($comment['is_customer_notified']) ? $comment['is_customer_notified'] : '';
                $salesrep = $this->getRequest()->getPost('salesrep');
                if (isset($data['billing_address'])){
                    $accountData = array_merge($data['account'], $data['billing_address']);
                }
                $this->_getOrderCreateModel()->setData('account', $accountData);
                if (!$this->_getQuote()->getR4qToken()) {
                    $this->_getQuote()->setR4qToken(sha1(time() . rand(1000000000, 9999999999) . rand(1000000000, 9999999999)));
                }
                if(!$this->getRequest()->getPost('shipping_same_as_billing') || Mage::helper('request4quote')->canShowBillingAddressAdmin() == 0)
                {
                    $syncFlag = 0;
                } else {
                    $syncFlag = $this->getRequest()->getPost('shipping_same_as_billing') == 'on'?1:0;
                }
                $this->_getOrderCreateModel()->setShippingAsBilling($syncFlag);
                $quote->setR4qShippingAsBilling((int)$syncFlag);
                $quote->setShippingAsBilling((int)$syncFlag);
                $this->_getOrderCreateModel()->saveCustomer();
                $quote->setCustomerFirstname($accountData['firstname']);
                $quote->setCustomerLastname($accountData['lastname']);
                $quote->setCustomerEmail($accountData['email']);
                $quote->save();
                //save item data
                $r4qData = $this->getRequest()->getPost('item');
                foreach ($r4qData as $itemId => $itemData) {
                    $r4qItem = Mage::getModel('request4quote/quote_item')->load($itemId);
                    $r4Quote = Mage::getModel('request4quote/quote')->loadByIdWithoutStore($quote->getId());
                    if ($r4qItem->getId() && $r4Quote->getId()) {
                        $r4qItem->setQuote($r4Quote);
                        if (isset($itemData['r4q_note'])) {
                            $r4qItem->setR4qNote($itemData['r4q_note']);
                        }
                        if (isset($itemData['r4q_price_proposal']) && is_numeric($itemData['r4q_price_proposal'])) {
                            $priceProposal = (float)$itemData['r4q_price_proposal'];
                            $r4qItem->setR4qPriceProposal($priceProposal);
                        }
                        $r4qItem->save();
                    } else {
                        throw new Exception($this->__('Wrong Quote Item ID'));
                    }
                }
                foreach($this->_getQuote()->getAllItems() as $item){
                    Mage::helper('request4quote')->saveStartEndDatesToQuote($quote, $item);
                }
                $quote->setSalesrep($salesrep);
                $quote->setR4qPhone($accountData['telephone']);
                $quote->setR4qStatus($status);
                /** Save quote comments */
                if($appendComments){
                    $commentItem = Mage::getModel('request4quote/comments');
                    $commentItem->setComment($commentForm);
                    $commentItem->setR4qId($quote->getId());
                    $commentItem->setStatus($status);
                    $commentItem->setIsCustomerNotified($notifyCustomer);
                    $commentItem->setIsVisibleOnFront($visibleFront);
                    $commentItem->setCreatedAt(time());
                    $user = Mage::getSingleton('admin/session');
                    $adminname = $user->getUser()->getFirstname() . ' ' . $user->getUser()->getLastname();
                    $commentItem->setSubmittedBy('admin: ' . $adminname);
                    try {
                        $commentItem->save();
                    } catch (Exception $e){
                        Mage::log($e);
                    }
                }
                // Override set date
                if(isset($datas['created_at']) && !empty($datas['created_at'])) {
                    $quote->setCreatedAt($datas['created_at']);
                }
                if(isset($datas['expiration_date']) && !empty($datas['expiration_date'])) {
                    $quote->setExpirationDate($datas['expiration_date']);
                } elseif(isset($datas['created_at']) && !empty($datas['created_at'])) {
                    $expirationDate = Mage::getModel('core/date')->timestamp(strtotime($datas['created_at'] . ' + 1 month'));
                    $expirationDate = date('Y-m-d', $expirationDate);
                    $quote->setExpirationDate($expirationDate);
                } else {
                    $expirationDate = Mage::getModel('core/date')->timestamp(strtotime(date('Y-m-d', time()) . ' + 1 month'));
                    $expirationDate = date('Y-m-d', $expirationDate);
                    $quote->setExpirationDate($expirationDate);
                }
                $quote->save();
                /** Send Email */
                if (isset($data['send_confirmation'])) {
                    $emailComments = null;
                    if($appendComments && $notifyCustomer){
                        $emailComments = $commentForm;
                    }
                    Mage::helper('request4quote/email')->sendRequestProposalNotification($quote, $emailComments);
                }
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Quote request has been saved successfully.'));
                $this->_redirect('*/adminhtml_quote/');
            } else {
                throw new Exception($this->__('Please add at least one product to the request.'));
            }
        } catch (Mage_Payment_Model_Info_Exception $e) {
            $this->_getOrderCreateModel()->saveQuote();
            $message = $e->getMessage();
            if( !empty($message) ) {
                $this->_getSession()->addError($message);
            }
            $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            $message = $e->getMessage();
            if( !empty($message) ) {
                $this->_getSession()->addError($message);
            }
            $this->_redirect('*/*/');
        }
        catch (Exception $e){
            $this->_getSession()->addException($e, $this->__('Quote request saving error: %s', $e->getMessage()));
            $this->_redirect('*/*/');
        }
    }
}