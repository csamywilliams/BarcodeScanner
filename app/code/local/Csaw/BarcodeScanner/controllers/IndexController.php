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

      Mage::log($identifier, null, 'identifier.log');

      if(isset($code) && !empty($identifier))
      {
        $product = Mage::getModel('barcodescanner/find')->findProduct($code, $identifier);
      } else {
        $product = "Product not found, please try a different code";
      }
      Mage::log($product, null, 'item.log');

      $this->getResponse()->setBody(json_encode($product));

    }

    public function saveAction()
    {
      $items = $this->getRequest()->getPost('results');
      $action = $this->getRequest()->getPost('action');

      $operator = null;
      switch($action)
      {
        case "incoming":
          $operator = '+';
          break;
        case "outgoing":
          $operator = '-';
          break;
        case "update":
          $operator = '=';
          break;
        default:
          $msg = "Unable to perform action";
      }

      if(isset($operator) && $operator != null)
      {
        $msg = Mage::getModel('barcodescanner/save')->saveProducts($items, $operator);
      } else
      {
        Mage::log("Problem with operator, could not perform action", null, 'indexErrorController.log');
        $msg = "Unable to save items";
      }

      Mage::log($items, null, 'saved.log');

      echo $msg;

    }

}

?>
