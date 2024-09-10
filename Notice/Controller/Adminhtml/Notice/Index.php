<?php
namespace Kitchen\Notice\Controller\Adminhtml\Notice;



class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Notice')));
        $resultPage->setActiveMenu('Kitchen_Notice::Notices');
        $resultPage->addBreadcrumb(__('notice'), __('notice'));
        $resultPage->addBreadcrumb(__('my notice'), __('my notice'));

		return $resultPage;
	}


}