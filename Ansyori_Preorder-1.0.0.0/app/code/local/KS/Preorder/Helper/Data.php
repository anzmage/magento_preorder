<?php
class KS_Preorder_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function preorderSet($order_id)
	{
		$ord = Mage::getModel('sales/order')->load($order_id)->getAllItems();
		
		
		
		foreach($ord as $data)
		{
			//echo $nama = $data->getName();
			
			$PREORDER_FLAG = Mage::getModel('catalog/product')->load($data->getProductId())->getIsPreorder();
			
			if($PREORDER_FLAG){
			$nama = $data->getName();
			$data->setName($nama . ' [Preorder Item]')
				 ->save();
			};
		}
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
	 