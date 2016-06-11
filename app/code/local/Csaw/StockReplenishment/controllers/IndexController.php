<?php
class Csaw_StockReplenishment_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
       $this->loadLayout();
      //  $name =  $this->getFullActionName();
      //  $block = $this->getLayout()
      //                   ->createBlock('core/text', 'example-block')
      //                   ->setText('<h1>Hello World</h1>');
       //
      //   $this->_addContent($block);
       //Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
       $this->renderLayout();

    }

}

?>
