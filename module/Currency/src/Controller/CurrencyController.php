<?php

namespace Currency\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CurrencyController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel([
            'currency' => '',
        ]);
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}