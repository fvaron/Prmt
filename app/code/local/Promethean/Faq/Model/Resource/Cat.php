<?php
/**
 * This file is part of Promethean_Faq for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Faq
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */
class Promethean_Faq_Model_Resource_Cat extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Constructor
     */
    public function _construct()
    {
        $this->_init('faq/cat', 'id');
    }

    /**
     * Perform operations after object save
     *
     * @param Mage_Core_Model_Abstract $object
     *
     * @return Promethean_Faq_Model_Resource_Cat
     */
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        /**
         * Handle stores associations
         */
        $this->_handleStoresAssociations($object);

        return parent::_afterSave($object);
    }

    /**
     * Perform operations after object load
     *
     * @param Mage_Core_Model_Abstract $object
     *
     * @return Promethean_Faq_Model_Resource_Cat
     */
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        if ($object->getId()) {
            $stores = $this->_lookupStoreIds($object->getId());
            $object->setData('store_id', $stores);
            $object->setData('stores', $stores);
        }

        return parent::_afterLoad($object);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param Promethean_Faq_Model_Cat $object
     *
     * @return Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $stores = array(
                (int)$object->getStoreId(),
                Mage_Core_Model_App::ADMIN_STORE_ID,
            );

            $select->join(
                array('fcs' => $this->getTable('faq/categories_store')),
                $this->getMainTable() . '.id = fcs.cat_id',
                array('store_id')
            )
            ->where('fcs.store_id in (?) ', $stores)
            ->limit(1);
        }

        return $select;

    }

    /**
     * Get store ids to which specified item is assigned
     *
     * @param int $id
     *
     * @return array
     */
    protected function _lookupStoreIds($id)
    {
        $adapter = $this->_getReadAdapter();

        $select = $adapter->select()
            ->from($this->getTable('faq/cat_store'), 'store_id')
            ->where('cat_id = :cat_id');

        $binds = array(
            ':cat_id' => (int)$id
        );

        return $adapter->fetchCol($select, $binds);
    }

    /**
     * Handle stores associations
     *
     * @param Mage_Core_Model_Abstract $object
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _handleStoresAssociations(Mage_Core_Model_Abstract $object)
    {
        $oldStores = $this->_lookupStoreIds($object->getId());

        $newStores = (array)$object->getStores();

        $table = $this->getTable('faq/cat_store');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);

        if ($delete) {
            $where = array(
                'cat_id = ?' => (int)$object->getId(),
                'store_id IN (?)' => $delete
            );

            $this->_getWriteAdapter()->delete($table, $where);
        }

        if ($insert) {
            $data = array();

            foreach ($insert as $storeId) {
                $data[] = array(
                    'cat_id' => (int)$object->getId(),
                    'store_id' => (int)$storeId
                );
            }

            $this->_getWriteAdapter()->insertMultiple($table, $data);
        }

        return $object;
    }
}