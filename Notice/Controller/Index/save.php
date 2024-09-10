<?php

namespace Kitchen\Notice\Controller\Index;

use Kitchen\Notice\Model\NoticeoFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Model\QuoteFactory;

class Save extends Action
{
    protected $resultJsonFactory;
    protected $quoteFactory;
    protected $checkoutSession;
    protected $noticeFactory;
    protected $customerSession;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        QuoteFactory $quoteFactory,
        CustomerSession $customerSession,
        NoticeoFactory $noticeFactory
    ) {
        parent::__construct($context);

        $this->resultJsonFactory = $resultJsonFactory;
        $this->quoteFactory = $quoteFactory;
        $this->customerSession = $customerSession;
        $this->noticeFactory = $noticeFactory;
    }

    public function execute(): Json
    {
        $result = $this->resultJsonFactory->create();
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);

        $checks = $data['value'];
        $customerId = $this->customerSession->getCustomerId();
        

        $getNotice = $this->noticeFactory->create();
        $getNotice->setCustomerId($customerId);
        $getNotice->setNotice($checks);
        $getNotice->save();

        return $result->setData([
            'checkbox' => $checks,
            'message' => 'checks exists',
            'customer_id' => $customerId
        ]);
    }

   
}
