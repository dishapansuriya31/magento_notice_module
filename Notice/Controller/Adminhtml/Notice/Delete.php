<?php
/**
* Copyright © Magento, Inc. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Kitchen\Review\Controller\Adminhtml\Page;
 
use Magento\Framework\App\Action\HttpPostActionInterface;
use Kitchen\Review\Model\ReviewsFactory;
 
/**
* Delete CMS page action.
*/
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Magento_Cms::page_delete';
 
    protected $reviewsFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        ReviewsFactory $galleryFactory,
    ) {
        parent::__construct($context);
        $this->galleryFactory = $galleryFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('k_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->galleryFactory->create()->load($id);
                $pageModel->delete();
                
                $this->messageManager->addSuccessMessage(__('The page has been deleted.'));
               // return $resultRedirect->setPath('*/*/');
            } catch (\Exception  $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                //return $resultRedirect->setPath('*/*/edit', ['blog_id' => $id]);
            }
        }
        
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));
        
        // go to grid
        $this->_redirect('review/index/index');
    }
}