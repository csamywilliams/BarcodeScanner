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
  public function saveProducts($items, $action)
  {
    foreach ($items as $item) {
        $sku = $item['sku'];
        $qty = (int) $item['qty_input'];

        $product = Mage::getModel('catalog/product')->loadByAttribute('SKU', $sku);

        if(isset($product))
        {
          $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);

          $productQty = (int) $stock->getQty();
          $quantity = null;

          switch($action)
          {
            case "incoming":
              $quantity = $productQty + $qty;
              break;
            case "outgoing":
              $quantity = $productQty - $qty;
              break;
            case "update":
              $quantity = $qty;
              break;
            default:
              $msg = "Unable to perform action";
          }

          //if quantity is less than 0, then stock is 0
          if ($quantity < 0) {
            $quantity = 0;
          }

          //set quantity
          $stock->setQty($quantity);
          $stock->setIsInStock((int)($quantity > 0));

          //save the item
          $success = false;
          try {
            $stock->save();
            $success = true;
          } catch catch (Exception $e) {
            $success = false;
            Mage::log('Error with saving product ' .$sku, null, 'saveError.log');
          }

          return $success;
        }
    }
  }
}
