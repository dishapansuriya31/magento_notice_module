<?php
declare(strict_types=1);

namespace Kitchen\Notice\Controller\Adminhtml\Notice;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Notice\Model\NoticesFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var NoticesFactory
     */
    private $customersFactory;
 
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;
 
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
 
    /**
     * @param Action\Context $context
     * @param NoticesFactory $customersFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
 
    public function __construct(
        Action\Context $context,
        NoticesFactory $customersFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->customersFactory = $customersFactory;
        $this->filesystem = $filesystem;
        $this->storeManager = $storeManager;
    }
 
    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        // echo "<pre>";
        // print_r($data);
        // die;
        
        if ($data) {
 
            try {
               
                if (!empty($data['notice_id'])) {
                   
                    $model = $this->customersFactory->create()->load($data['notice_id']);
                } else {
                   
                    $model = $this->customersFactory->create();
                }
 
                $model->setTitle($data['title']);
                $model->setDescription($data['description']);
                $model->setEmail($data['email']);
                $model->setGender($data['gender']);
                $model->setBirthDate($data['birth_date']);
                // $model->setProfileImage($data['profile_image']);
                $model->setAddress($data['address']);
 
                $hobbies = implode(', ', $data['customer_group']);
                $model->setCustomerGroup($hobbies);
              
                $model->setStatus($data['Status']);
                
 
                
                    
 
 
                $model->save();
                $this->messageManager->addSuccessMessage(__(' has been saved.'));
            }
            
            catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
     
            // Redirect back to the customer page
            return $resultRedirect->setPath('notice/notice/index');
        }
     
        // If no data is available, redirect back to the customer page
        return $resultRedirect->setPath('notice/notice/index');
    }
 
    
}