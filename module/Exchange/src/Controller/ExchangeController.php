<?php

namespace Exchange\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Exchange\Form\ExchangeForm;

class ExchangeController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new ExchangeForm();
        $form->get('submit')->setValue('Convert');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        return $this->redirect()->toRoute('exchange');
    }
}