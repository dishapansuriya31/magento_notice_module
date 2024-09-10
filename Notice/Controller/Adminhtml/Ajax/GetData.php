<?php
namespace Kitchen\Notice\Controller\Adminhtml\Ajax;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Kitchen\Notice\Model\NoticesFactory;

class GetData extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var NoticesFactory
     */
    protected $NoticesFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param NoticesFactory $NoticesFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        NoticesFactory $NoticesFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->NoticesFactory = $NoticesFactory;
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        try {
            // Load data from your model or any other source
            $data = $this->NoticesFactory->getData();

            // Format the data as needed
            $formattedData = [
                'title' => $data->getTitle(),
                'description' => $data->getDescription()
            ];

            // Return the data as JSON
            return $resultJson->setData($formattedData);
        } catch (\Exception $e) {
            // Handle any errors
            return $resultJson->setData(['error' => $e->getMessage()]);
        }
    }
}
