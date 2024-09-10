<?php
 
namespace Kitchen\Notice\Block;
 
use Kitchen\Notice\Model\NoticesFactory;
use Kitchen\Notice\Model\NoticeoFactory;
use Magento\Customer\Model\Session as CustomerSession;
 
class Notice extends \Magento\Framework\View\Element\Template
{
    protected $noticesFactory;
    protected $noticeoFactory;
    protected $customerSession;
 
    public function __construct(
        NoticesFactory $noticesFactory,
        CustomerSession $customerSession,
        NoticeoFactory $noticeoFactory,
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        $this->noticesFactory = $noticesFactory;
        $this->noticeoFactory = $noticeoFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }
 
    public function getCustomerGroup()
    {
        // $customerId = $this->customerSession->getCustomerId();
        $customerGrpId = $this->customerSession->getCustomerGroupId();
 
        return $customerGrpId;
    }

 
    public function showTitle()
    {
        // echo "This is Notice";
        $getNotice = $this->noticesFactory->create();
        $getCollection = $getNotice->getCollection()->addFieldToFilter('customer_group',$this->getCustomerGroup());
 
        foreach ($getCollection as $row) {
            echo $row->getTitle();
        }
    }

    public function loggedIn()
    {
        $loggedIn = $this->customerSession->isLoggedIn();
 
        return $loggedIn;
    }
 
    public function checksRead()
    {
        $customerId = $this->customerSession->getCustomerId();
        if (!$customerId) {
            return false;
        }
         
 
        $notice = $this->noticeoFactory->create()->getCollection()
        ->addFieldToFilter('customer_id', $customerId)
        ->addFieldToFilter('notice', 1)
        ->getFirstItem();
 
        return (bool) $notice->getId();
    }
 
    public function showDescription()
    {
        // echo "This is Notice";
        $getNotice = $this->noticesFactory->create();
        $getCollection = $getNotice->getCollection()->addFieldToFilter('customer_group',$this->getCustomerGroup());
 
        foreach ($getCollection as $row) {
            echo $row->getDescription();
        }
    }
}
 