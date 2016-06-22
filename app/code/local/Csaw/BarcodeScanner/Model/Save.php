<?php
/**
* Barcode Scanner Save Model
* Using the operator either increase, decrease or update the quantity of the product
* @author Amy Williams
* @copyright 21/06/16
*/
class Csaw_BarcodeScanner_Model_Save extends Mage_Core_Model_Abstract {

  public function __construct()
  {
    $this->_init('barcodescanner/save');
  }

  /**
  * Save products
  * @param items - list of items to save
  * @param operator - '+','-','='
  */
  public function saveProducts($items, $operator)
  {
    foreach ($items as $item) {
        $sku = $item['sku'];
        $qty = $item['qty'];

        Mage::log($sku, null, 'save.log');
        Mage::log($qty, null, 'qty.log');
    }


  }
}
