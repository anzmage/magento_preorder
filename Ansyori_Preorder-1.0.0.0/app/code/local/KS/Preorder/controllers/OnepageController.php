<?php

require_once "Mage/Checkout/controllers/OnepageController.php"; 
class KS_Preorder_OnepageController extends Mage_Checkout_OnepageController
{
	
	public function successAction()
	{
		$lastQuoteId = $this->getOnepage()->getCheckout()->getLastQuoteId();
        $lastOrderId = $this->getOnepage()->getCheckout()->getLastOrderId();
		Mage::helper('preorder')->preorderSet($lastOrderId);	
		return parent::successAction();
	}
	
	
	public function failureAction()
	{
		$lastQuoteId = $this->getOnepage()->getCheckout()->getLastQuoteId();
        $lastOrderId = $this->getOnepage()->getCheckout()->getLastOrderId();
		Mage::helper('preorder')->preorderSet($lastOrderId);	
		
		return parent::failureAction();
	}
	
}