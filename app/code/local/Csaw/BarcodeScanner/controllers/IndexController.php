<?php
class Csaw_BarcodeScanner_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
       $this->loadLayout();
       $this->renderLayout();
    }

    public function saveAction()
    {
      var_dump($this->getRequest()->getParams('transfer-action'));

    }

}

?>
