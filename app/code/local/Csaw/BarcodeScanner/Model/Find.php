<?php

class Csaw_BarcodeScanner_Model_Find extends Mage_Core_Model_Abstract {

  public function _construct()
  {
    $this->_init('barcodescanner/find');
  }

  public function findProduct($code, $identifiers)
  {
    //if code contains only digits then it must be an id, GTIN or EAN
    if(ctype_digit($code))
    {

      $length = sizeof($identifiers);

      if($length == 1)
      {
        $product = getProduct($code, $identifiers[0]);
      } else
      {
        $product = searchByMultipleIdentifiers($code, $identifiers);
      }

    } else
    {
      if (in_array("SKU"))
      {
        //can only be a SKU based on our individual products
          $product = Mage::getModel('catalog/product')->loadByAttribute('SKU', $code);
      }
    }

    if(isset($product) && $product != null)
    {
      //can return the product
      if (in_array("EAN"))
      {
          $product = Mage::getModel('catalog/product')->loadByAttribute('EAN', $code);
      } else {
        //something has gone wrong
      }
    }


    echo "im in here";
  }

  /**
  * Get product from database based on the search code and identifiers
  */
  public function getProduct($code, $attribute)
  {
    $product = null;
    //if it's a GTIN (most likely)
    if(in_array("GTIN", $attribute))
    {
        $product = Mage::getModel('catalog/product')->loadByAttribute('GTIN', $code);
    } else if (in_array("EAN", $attribute))
    {
        $ean_product = Mage::getModel('catalog/product')->loadByAttribute('EAN', $code);
    } else if (in_array("ID", $attribute))
    {
        $product = Mage::getModel('catalog/product')->load($code);
    }

    return $product;
  }

  /**
  * Need to get all products by multiple identifiers and return those products in an array
  */
  public function searchByMultipleIdentifiers($code, $identifiers)
  {
    $products_found = array();
    foreach($identifiers as $attribute)
    {
      $product = getProduct($code, $attribute);

      if(isset($product) && $product != null)
      {
        array_push($products_found, $product);
      }
    }
    return $products_found;
  }

}
