<?php
class Csaw_BarcodeScanner_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
       $this->loadLayout();
       $this->renderLayout();
    }

    public function searchAction()
    {
      //get the barcode, identifier and action for the product scanned or entered.
      $code = $this->getRequest()->getPost('input');
      $action = $this->getRequest()->getPost('action');
      $identifier = $this->getRequest()->getPost('identifier');

      if(isset($code) && !empty($identifier))
      {
        $product = Mage::getModel('barcodescanner/find')->findProduct($code, $identifier);
      }
      Mage::log($product, null, 'item.log');

      $this->getResponse()->setBody(json_encode($product));

    }

}

?>
