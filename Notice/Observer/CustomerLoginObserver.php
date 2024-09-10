<?php
namespace Kitchen\Notice\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class CustomerLoginObserver implements ObserverInterface
{
    protected $customerSession;
    protected $response;
    protected $pageFactory;

    public function __construct(
        CustomerSession $customerSession,
        ResponseInterface $response,
        PageFactory $pageFactory
    ) {
        $this->customerSession = $customerSession;
        $this->response = $response;
        $this->pageFactory = $pageFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->customerSession->isLoggedIn()) {
            $customerName = $this->customerSession->getCustomer()->getName();
            $this->addCustomerNameToPage($customerName);
        }
    }

    protected function addCustomerNameToPage($customerName)
{
    $page = $this->pageFactory->create();
    $block = $page->getLayout()->getBlock('notice.search.link');
    if ($block) {
        $block->setData('customerName', $customerName);
    }
}
}
