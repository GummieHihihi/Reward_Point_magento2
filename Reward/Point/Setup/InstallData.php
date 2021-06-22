<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Reward\Point\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
          /**
           * Install messages
           */
          $entityID = array();
          $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
          $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
          $connection = $resource->getConnection();
          $select = $connection->select()
          ->from(
            ['customer_entity'],
            ['entity_id']
          );

          // tao array chua entity cua customer
          $data1 = $connection->fetchAll($select);
          for ($i=0; $i < count($data1); $i++) { 
            array_push($entityID, $data1[$i]["entity_id"]);
          }
          
          //danh sach list de nhap vao rable ( array trong array)
          $prepareData = array();
          for ($i=0; $i < count($entityID); $i++) { 
            $data = array(
              "entity_id" => $entityID[$i],
              "client_point" => 0
            );
            array_push($prepareData, $data);
          }

          // dien data vao bang trong database 
          // for ($i=0; $i < count($prepareData); $i++) { 
            foreach ($prepareData as $bind) {
              $setup->getConnection()
              ->insertForce($setup->getTable('clientpoint_demo'), $bind);
            }
          // }
        }
      }