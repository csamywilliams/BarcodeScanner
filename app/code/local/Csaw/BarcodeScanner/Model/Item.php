<?php

class Csaw_BarcodeScanner_Model_Item
{
  public $id;
  public $sku;
  public $qty;
  public $stock_required;
  public $gtin;
  public $ean;

  public function __construct($data)
  {
     $this->id = $data['product']['entity_id'];
     $this->sku = $data['product']['sku'];
     $this->qty = $data['stock'];
    // $this->stock_required = $stock_required;
     $this->gtin = $data['product']['c2c_gtin'];
     $this->ean = $data['product']['gr_ean'];

  }


}
 ?>
