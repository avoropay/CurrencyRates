<?php

namespace Currency\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Currency\Model\CurrencyTable;

class CurrencyController extends AbstractActionController
{

    private $table;

    public function __construct(CurrencyTable $table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {

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

        $graphSize = [1100,330];
        $filename = 'public/temp/currency_chart_big.jpg';

        require_once getcwd().'/module/graph/graph.php';

        $filename = 'temp/currency_chart_big.jpg';


        // Grab the paginator from the AlbumTable:
        $paginator = $this->table->fetchAll(true);

        // Set the current page to what has been passed in query string,
        // or to 1 if none is set, or the page is invalid:
        $page = (int) $this->params()->fromQuery('page', 1);
        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);

        // Set the number of items per page to 10:
        $paginator->setItemCountPerPage(15);


        return new ViewModel([
                'filegraph' => $filename,
                'paginator' => $paginator
            ]
        );
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