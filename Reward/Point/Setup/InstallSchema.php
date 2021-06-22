<?php
namespace Reward\Point\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
/**
 * Class InstallSchema
 * @package Magestore\Multivendor\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();
        /*
         * Drop tables if exists
         */
        
        //install table client point in customer grid
        $installer->getConnection()->dropTable($installer->getTable('clientpoint_demo'));
        $installer->getConnection()->dropTable($installer->getTable('earning_rules'));
        $installer->getConnection()->dropTable($installer->getTable('exchange_rate'));
        $installer->getConnection()->dropTable($installer->getTable('transaction'));
        $installer->getConnection()->dropTable($installer->getTable('temp_trans'));
        $installer->getConnection()->dropTable($installer->getTable('temp_discount'));
        
        $table = $installer->getConnection()->newTable(
            $installer->getTable('clientpoint_demo')
        )->addColumn(
            'client_point_id', Table::TYPE_INTEGER, null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'entity_id', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true],
            'entity_id Id'
        )->addColumn(
            'client_point', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'client point of the customer'
        );
        $installer->getConnection()->createTable($table);
        $installer->endSetup();

        //install table earning rules
        $table = $installer->getConnection()->newTable(
            $installer->getTable('earning_rules')
        )->addColumn(
            'ruleid', Table::TYPE_INTEGER, null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'rule_name', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'entity_id Id'
        )->addColumn(
            'start', Table::TYPE_DATETIME, null,
            ['nullable' => true, 'unsigned' => true],
            'start'
        )->addColumn(
            'end', Table::TYPE_DATETIME, null,
            ['nullable' => true, 'unsigned' => true],
            'end'
        )->addColumn(
            'status', Table::TYPE_SMALLINT, null,
            ['nullable' => false, 'unsigned' => true],
            'status'
        )->addColumn(
            'website', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'website'
        )
        ->addColumn(
            'customer_group', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'customer group'
        )->addColumn(
            'type', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'type of rules'
        )->addColumn(
            'receive_point', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'receive point'
        )->addColumn(
            'spent_amount', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'spent amount'
        )->addColumn(
            'note_storeview', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'note storeview'
        )->addColumn(
            'default_storeview', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'default store view'
        )->addColumn(
            'priority', Table::TYPE_INTEGER, null,
            ['nullable' => true, 'unsigned' => true],
            'priority'
        );;
        $installer->getConnection()->createTable($table);

        //create table exchange rate
        $table = $installer->getConnection()->newTable(
            $installer->getTable('exchange_rate')
        )->addColumn(
            'exchangeid', Table::TYPE_INTEGER, null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'website', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'entity_id Id'
        )->addColumn(
            'cusstomerGroup', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'customer Group'
        )->addColumn(
            'exchangeRate', Table::TYPE_FLOAT, null,
            ['nullable' => true, 'unsigned' => true],
            'end'
        )->addColumn(
            'status', Table::TYPE_SMALLINT, null,
            ['nullable' => false, 'unsigned' => true],
            'status'
        )->addColumn(
            'priority', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true],
            'priority'
        );
        $installer->getConnection()->createTable($table);

        //install transaction
        $table = $installer->getConnection()->newTable(
            $installer->getTable('transaction')
        )->addColumn(
            'transid', Table::TYPE_INTEGER, null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'ID'
        )->addColumn(
            'customer_name', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'Customer name'
        )->addColumn(
            'mail', Table::TYPE_TEXT, null,
            ['nullable' => true, 'unsigned' => true],
            'mail'
        )->addColumn(
            'change_point', Table::TYPE_INTEGER, null,
            ['nullable' => true, 'unsigned' => true],
            'change_point'
        )->addColumn(
            'balance', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true],
            'balance'
        )->addColumn(
            'point_expire', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true],
            'point expire'
        )->addColumn(
            'website', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'website'
        )->addColumn(
            'create_by', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'created by'
        )->addColumn(
            'note', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'note'
        )->addColumn(
            'transaction_date', Table::TYPE_DATETIME, null,
            ['nullable' => false, 'unsigned' => true],
            'date'
        )->addColumn(
            'expires_date', Table::TYPE_DATETIME, null,
            ['nullable' => false, 'unsigned' => true],
            'expire date'
        )->addColumn(
            'type', Table::TYPE_TEXT, null,
            ['nullable' => false, 'unsigned' => true],
            'type'
        );
        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()->newTable(
            $installer->getTable('temp_trans')
        )->addColumn(
            'temp_id', Table::TYPE_INTEGER, null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'temp id'
        )->addColumn(
            'total', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true],
            'total'
        )->addColumn(
            'status', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'status'
        );
        $installer->getConnection()->createTable($table);

        $table = $installer->getConnection()->newTable(
            $installer->getTable('temp_discount')
        )->addColumn(
            'discountid', Table::TYPE_INTEGER, null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'temp id'
        )->addColumn(
            'point', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true],
            'point'
        )->addColumn(
            'money', Table::TYPE_INTEGER, null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'money'
        );
        $installer->getConnection()->createTable($table);
        
        $installer->endSetup();
        
    }
}