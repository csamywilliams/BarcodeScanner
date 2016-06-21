<?php
/**
* Barcode Scanner Find Model
* Model to retrieve the product information based on the user input entered and identifier selected.
* @author Amy Williams
* @copyright 21/06/16
*/
class Csaw_BarcodeScanner_Model_Find extends Mage_Core_Model_Abstract {

  public function __construct()
  {
    $this->_init('barcodescanner/find');
  }

  /**
  * Find the product using the user input and identifier.
  * @param code - user input barcode, ID, SKU
  * @param identifier - SKU, ID, GTIN or EAN
  */
  public function findProduct($code, $identifier)
  {

    $item_found = null;
    //if code contains only digits then it must be an id, GTIN or EAN
    if(ctype_digit($code))
    {
      $product = $this->getProduct($code, $identifier);
    } else
    {
        //can only be a SKU based on our individual products
        $product = Mage::getModel('catalog/product')->loadByAttribute('SKU', $code);
    }

    if(isset($product))
    {
      $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
      $item_found = Mage::getModel('barcodescanner/item', array('product' => $product->getData(),
                                                          'stock' =>  $stock->getQty()));
    }

    if(!isset($item_found))
    {
      $item_found = "Product not found, please try again";
    }

    Mage::log($product, null, 'item.log');
    return $item_found;

  }

  /**
  * Get product from database based on the search code and identifiers
  * @param code - user input
  * @param attribute - product identifier
  * @return product object
  */
  public function getProduct($code, $attribute)
  {
    $product = null;

    switch ($attribute) {
      case "GTIN":
        $product = Mage::getModel('catalog/product')->loadByAttribute('c2c_gtin', $code);
      break;
      case "EAN":
        $product = Mage::getModel('catalog/product')->loadByAttribute('EAN', $code);
      break;
      case "ID":
        $product = Mage::getModel('catalog/product')->load($code);
      break;
      case "SKU":
        $product = Mage::getModel('catalog/product')->loadByAttribute('SKU', $code);
      break;
    }

    return $product;
  }
}
