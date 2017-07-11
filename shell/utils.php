<?php

require_once 'abstract.php';

class Mage_Shell_Utils extends Mage_Shell_Abstract
{

    public function run()
    {
        if ($this->getArg('addTaxToProduct')) {
            $indexers = Mage::getSingleton('index/indexer')->getProcessesCollection();

            foreach ($indexers as $process) {
                $process->setMode(Mage_Index_Model_Process::MODE_MANUAL)->save();
            }

            ini_set('memory_limit', '2560M');
            ini_set('max_execution_time', '0');

            $collection = Mage::getResourceModel('catalog/product_collection')
                ->addAttributeToSelect('*');

            foreach ($collection as $_product) {
                $_product = Mage::getModel('catalog/product')->load($_product->getId());
                echo $_product->getSku();
                echo PHP_EOL;
                $_product->setData('tax_class_id', 2)->save();
            }

            $indexers = Mage::getModel('index/process')->getCollection();

            foreach ($indexers as $process) {
                $process->reindexAll();
            }

            $indexers = Mage::getSingleton('index/indexer')->getProcessesCollection();

            foreach ($indexers as $process) {
                $process->setMode(Mage_Index_Model_Process::MODE_REAL_TIME)->save();
            }

            return;
        }

        echo $this->usageHelp();
    }

    /**
     * Retrieve Usage Help Message
     *
     */
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f utils.php -- [option]

 -- addTaxToProduct
USAGE;
    }
}

$shell = new Mage_Shell_Utils();
$shell->run();