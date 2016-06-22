<?php
class Csaw_BarcodeScanner_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
       $this->loadLayout();
       $this->renderLayout();
    }

    /**
    * Find product by code and identifier
    */
    public function searchAction()
    {
      //get the barcode, identifier and action for the product scanned or entered.
      $code = $this->getRequest()->getPost('input');
      $identifier = $this->getRequest()->getPost('identifier');

      Mage::log($identifier, null, 'identifier.log');

      if(isset($code) && !empty($identifier))
      {
        $product = Mage::getModel('barcodescanner/find')->findProduct($code, $identifier);
      } else {
        $product = "Product not found, please try a different code";
      }

      $this->getResponse()->setBody(json_encode($product));

    }

    /**
    * Save action used by Ajax request to save the products
    */
    public function saveAction()
    {
      $items = $this->getRequest()->getPost('results');
      $action = $this->getRequest()->getPost('action');

      $msg = Mage::getModel('barcodescanner/save')->saveProducts($items, $action);

      $this->getResponse()->setBody(json_encode($msg));
    }

}

?>
