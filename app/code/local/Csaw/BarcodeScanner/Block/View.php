<?php
/**
 * Magento
 *
 * @category
 * @package     Csaw_BarcodeScanner_View
 * @copyright   Copyright (c) 2016 Amy Williams
 */

/**
 * View Form Block
 *
 * @category   Mage
 * @package    Csaw_BarcodeScanner_View
 * @author     Amy Williams
 */
class Csaw_BarcodeScanner_Block_View extends Mage_Adminhtml_Block_Report_Grid
{

    /**
     * Initialize Grid settings
     *
     */
    public function __construct()
    {
        $this->_blockGroup = 'foo_bar';
        $this->_controller = 'adminhtml_barcodescanner';
        $this->_headerText = $this->__('Amy');

        parent::__construct();
    }

}
