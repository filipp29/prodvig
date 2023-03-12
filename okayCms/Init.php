<?php


namespace Okay\Modules\SP\BitrixCRMIntegration\Init;


use Okay\Core\Modules\AbstractInit;
use Okay\Core\Modules\EntityField;
use Okay\Entities\CallbacksEntity;
use Okay\Entities\OrdersEntity;
use Okay\Helpers\OrdersHelper;
use Okay\Modules\SP\BitrixCRMIntegration\Extensions\CallbacksEntityExtension;
use Okay\Modules\SP\BitrixCRMIntegration\Extensions\OrdersHelperExtension;


class Init extends AbstractInit
{
    
    const EXTERNAL_ID_FIELD = 'bitrix_external_id';
    
    public function install()
    {
        $this->setBackendMainController('DescriptionAdmin');       
        
        $this->migrateEntityField(OrdersEntity::class, (new EntityField(self::EXTERNAL_ID_FIELD))->setTypeVarchar(255)->setIndex()->setNullable());
    }

    public function init()
    {
        $this->addPermission('simplamarket__bitrix_crm_integration');

        $this->registerBackendController('DescriptionAdmin');
        $this->addBackendControllerPermission('DescriptionAdmin', 'simplamarket__bitrix_crm_integration');
        
        $this->registerEntityField(OrdersEntity::class, self::EXTERNAL_ID_FIELD);
        
        
        $this->registerQueueExtension(
            ['class' => OrdersHelper::class,          'method' => 'finalCreateOrderProcedure'],
            ['class' => OrdersHelperExtension::class, 'method' => 'sendOrderToBitrix']);

        $this->registerQueueExtension(
            ['class' => CallbacksEntity::class,          'method' => 'add'],
            ['class' => CallbacksEntityExtension::class, 'method' => 'sendLeadToBitrix']);
        
    }
}