<?php
class KS_Preorder_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  //$cart = Mage::getSingleton('checkout/session')->getQuote();
		$cart = Mage::getModel('checkout/cart')->getQuote();
		echo '<pre>';
		echo (Mage::getModel('checkout/cart')->getQuote()->getId());
		echo print_r($cart->getData());
		die;		
				$found_preorder = false;
				
				foreach ($cart->getAllItems() as $item) {
					$productName = $item->getName();
					$sku = $item->getSku();
					$qty_item= $item->getQty();
					
					$PREORDER_FLAG = Mage::getModel('catalog/product')->load($item->getProductId())->getIsPreorder();
					if($PREORDER_FLAG){
						$found_preorder = true;
						$item->setName('Beda Nama dimari euy');
						$item->setQty(9);
						
						$item->save();
						echo 'ganti nama';
					}
				}


		/*if($found_preorder){
		
			foreach ($cart->getAllItems() as $item) {
					$productName = $item->getName();
					$sku = $item->getSku();
					$qty_item= $item->getQty();
					
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
		};*/
    }
	
	public function orderAction()
	{
		$ord = Mage::getModel('sales/order')->load(198)->getAllItems();
		
		echo '<pre>';
		
		foreach($ord as $data)
		{
			echo $nama = $data->getName();
			echo $nama = $data->getProductId();
			
			/*$data->setName($nama . ' Ahey')
				 ->save();*/
		}
		
		
		
	}
}