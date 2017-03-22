<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $client = new \Zend\Http\Client();
        $client->setUri('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');
        $response = $client->send();

        $page = (int) $this->params()->fromQuery('page', 1);        
        if ($response->isSuccess()) {
            $rates = json_decode($response->getBody());
            $currency_paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($rates));
            $page = ($page < 1) ? 1 : $page;
            $currency_paginator->setCurrentPageNumber($page);

            // Set the number of items per page to 10:
            $currency_paginator->setItemCountPerPage(10);
        }

        $client->setUri('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
        $response = $client->send();
        if ($response->isSuccess()) {
            $privat = json_decode($response->getBody());
        }

        $client->setUri('https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
        $response = $client->send();
        if ($response->isSuccess()) {
            $privat1 = json_decode($response->getBody());
        }

        //require ("../vendor/jpgraph/jpgraph.php");
        /*require ("jpgraph/jpgraph_pie.php");
        require ("../../vendor/jpgraph/jpgraph_pie3d.php");*/

        //$p1 = new PiePlot3d($data);

        return new ViewModel(['paginator' => $currency_paginator,
                            'privat' => $privat,
                            'privat1' => $privat1
            ]
        );
    }
}
