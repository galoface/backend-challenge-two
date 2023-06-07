<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Infobase\CustomerAccess\Controller\Adminhtml\CustomerAccessPage;

class Delete extends \Infobase\CustomerAccess\Controller\Adminhtml\CustomerAccessPage
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('customeraccesspage_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Infobase\CustomerAccess\Model\CustomerAccessPage::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Customeraccesspage.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['customeraccesspage_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Customeraccesspage to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

