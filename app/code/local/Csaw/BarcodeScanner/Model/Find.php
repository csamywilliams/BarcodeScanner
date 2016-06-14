<?php

class Csaw_BarcodeScanner_Model_Find extends Mage_Core_Model_Abstract {

  public function _construct()
  {
    $this->_init('barcodescanner/find');
  }

  public function findProduct()
  {
    echo "im in here";
  }

}
