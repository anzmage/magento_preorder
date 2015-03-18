<?php
class KS_Preorder_Model_Observer
{

			public function methodOne(Varien_Event_Observer $observer)
			{
				//Mage::dispatchEvent('admin_session_user_login_success', array('user'=>$user));
				//$user = $observer->getEvent()->getUser();
				//$user->doSomething();
				$this->checkPreorderItem();
				Mage::getSingleton('core/session')->addNotice('Only Pre-Order Items Allowed');
			}
		
			public function methodTwo(Varien_Event_Observer $observer)
			{
				//Mage::dispatchEvent('admin_session_user_login_success', array('user'=>$user));
				//$user = $observer->getEvent()->getUser();
				//$user->doSomething();
				$this->checkPreorderItem();
				Mage::getSingleton('core/session')->addNotice('Only Pre-Order Items Allowed');
				
			}
			
			public function checkPreorderItem()
			{
				$cart = Mage::getSingleton('checkout/session')->getQuote();
				
				$found_preorder = false;
				
				foreach ($cart->getAllItems() as $item) {
					$productName = $item->getName();
					$sku = $item->getSku();
					$qty_item= $item->getQty();
					/*conditional if sku is blahblahblah the set qty to blahblah */
					if($sku == 'YOUR SKU'):
						$item->setQty(1);
						$item->save();
					endif;
					$PREORDER_FLAG = Mage::getModel('catalog/product')->load($item->getProductId())->getIsPreorder();
					if($PREORDER_FLAG)
					$found_preorder = true;
				}


				if($found_preorder){
				/*--------------------------------------------*/
					foreach ($cart->getAllItems() as $item) {
							$productName = $item->getName();
							$sku = $item->getSku();
							$qty_item= $item->getQty();
							/*conditional if sku is blahblahblah the set qty to blahblah */
							if($sku == 'YOUR SKU'):
								$item->setQty(1);
								$item->save();
							endif;
							$PREORDER_FLAG = Mage::getModel('catalog/product')
											 ->load($item->getProductId())
											 ->getIsPreorder();
							if(!$PREORDER_FLAG)
							{
								$item->delete();
							}
						}
				Mage::getSingleton('core/session')->addNotice('Only Pre-Order Items Allowed');
				/*--------------------------------------------*/
				};
			}
		
}
