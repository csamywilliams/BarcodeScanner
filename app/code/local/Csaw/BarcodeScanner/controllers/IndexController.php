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

      echo "in saveAction";

      return("help me");
    }

}

?>
