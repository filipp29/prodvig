<?php


namespace Okay\Modules\SP\BitrixCRMIntegration\Extensions;


use Okay\Core\Cart;
use Okay\Core\EntityFactory;
use Okay\Core\Modules\Extender\ExtensionInterface;
use Okay\Entities\DeliveriesEntity;
use Okay\Entities\PaymentsEntity;
use Okay\Entities\PurchasesEntity;
use Okay\Modules\SP\BitrixCRMIntegration\Core\BitrixCRMApi;

class OrdersHelperExtension implements ExtensionInterface
{
    /**
     * @var Cart
     */
    private $cartCore;
    
    private $deliveriesEntity;
    
    private $paymentsEntity;
    
    private $purchasesEntity;
    
    private $bitrixApi;
    

    public function __construct(Cart $cartCore, EntityFactory $entityFactory, BitrixCRMApi $bitrixCRMApi)
    {
        $this->cartCore = $cartCore;
        $this->deliveriesEntity = $entityFactory->get(DeliveriesEntity::class);    
        $this->paymentsEntity = $entityFactory->get(PaymentsEntity::class);    
        $this->purchasesEntity = $entityFactory->get(PurchasesEntity::class);  
        $this->bitrixApi = $bitrixCRMApi;
    }

    public function sendOrderToBitrix($result, $order)
    {
        $cart = $this->cartCore->get();   
        
        if ($this->bitrixApi->isFastOrder($order)) {
            $purchases = $this->purchasesEntity->find(['order_id'=>intval($order->id)]);    
            $isFastOrder = true;
        } else {
            $purchases = $cart->purchases;    
            $isFastOrder = false;
        }             
        
        $bitrixOrder = $this->bitrixApi->addOrder($order, $isFastOrder);       
                             
        if($bitrixOrder['result']){
            $this->bitrixApi->addOrderProducts($bitrixOrder['result'], $purchases);
        }
        
    } 
}