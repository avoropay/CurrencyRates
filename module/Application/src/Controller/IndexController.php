<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;

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
            $currency_paginator->setItemCountPerPage(16);
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


        require_once ("vendor/jpgraph/jpgraph.php");
        require_once ('vendor/jpgraph/jpgraph_line.php');

        $adapter = new Adapter([
            'driver' => 'Pdo_Mysql',
            'database' => 'currency',
            'username' => 'currency',
            'password' => 'VG2YhpN4;',
            'hostname' => 'localhost',
            'charset' => 'utf8',
            'port' => '3306',
        ]);

        $ydata = array();
        $dates = array();

        foreach (['USD', 'EUR', 'GBP'] as $curr) {
            $result = $adapter->query("select exchange_rate/number_of_units as rate, STR_TO_DATE(date, '%d.%m.%Y') as 
          date  from currency_rate where letter_code = '$curr' and YEAR(STR_TO_DATE(date, '%d.%m.%Y')) >= 2014")->execute();

            foreach ($result as $row) {
                $ydata[$curr][] = (float)$row['rate'];
                $dates[$curr][] = $row['date'];
            }

        }

        $theme_class=new \UniversalTheme;

        $graph = new \Graph(730,330);

        $graph->SetScale('textlin');
        //$graph->SetScale('datlin');
        $graph->SetTheme($theme_class);



        $graph->img->SetAntiAliasing(false);
        //$graph->title->Set('Filled Y-grid');
        $graph->SetBox(false);
        //$graph->SetMargin(40,30,40,120);
        $graph->legend->SetShadow('gray@0.4',5);
        $graph->legend->SetPos(0.1,0.1,'right','top');

        $graph->img->SetAntiAliasing();

        $graph->xaxis->SetTickSide(SIDE_BOTTOM);
        $graph->yaxis->SetTickSide(SIDE_LEFT);
        $graph->xaxis->SetLabelAngle(90);
        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);

        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        $graph->xaxis->SetTickLabels($dates['USD']);
        //$graph->xaxis->SetTextLabelInterval(30);
        $graph->xaxis->SetTextTickInterval(30);

        $lineplot = new \LinePlot($ydata['USD']);
        $graph->Add($lineplot);
        $lineplot->SetColor('blue');
        $lineplot->SetLegend('USD');

        $lineplotEUR = new \LinePlot($ydata['EUR']);
        $graph->Add($lineplotEUR);
        $lineplotEUR->SetColor('green');
        $lineplotEUR->SetLegend('EUR');

        $lineplotRUR = new \LinePlot($ydata['GBP']);
        $graph->Add($lineplotRUR);
        $lineplotRUR->SetColor('black');
        $lineplotRUR->SetLegend('GBP');


        $graph->legend->SetFrameWeight(1);
        $graph->legend->SetColumns(6);


        $graph->Stroke('public/temp/test.jpg');


        return new ViewModel(['paginator' => $currency_paginator,
                            'privat' => $privat,
                            'privat1' => $privat1,
                            'filegraph' => 'temp/test.jpg',
                            'ydata' => $ydata
            ]
        );
    }

    public function graphAction()
    {
        require_once ("vendor/jpgraph/jpgraph.php");
        require_once ('vendor/jpgraph/jpgraph_line.php');

        $ydata = array(11,3,8,12,5,1,9,13,5,7);

        $graph = new \Graph(350,250);
        $graph->SetScale('textlin');

        $lineplot=new \LinePlot($ydata);
        $lineplot->SetColor('blue');

        $graph->Add($lineplot);
        $graph->Stroke();
    }
}
