<?php

namespace Currency\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
//use Zend\Paginator\Adapter\DbSelect;
//use Zend\Paginator\Paginator;

class CurrencyTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated = false)
    {
        if ($paginated) {
    //        return $this->fetchPaginatedResults();
        }

        return $this->tableGateway->select();
    }

    public function getCurrency($letter_code)
    {
        $rowset = $this->tableGateway->select(['letter_code' => $letter_code]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $letter_code
            ));
        }

        return $row;
    }

    /*private function fetchPaginatedResults()
    {
        // Create a new Select object for the table:
        $select = new Select($this->tableGateway->getTable());

        // Create a new result set based on the Album entity:
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Album());

        // Create a new pagination adapter object:
        $paginatorAdapter = new DbSelect(
        // our configured select object:
            $select,
            // the adapter to run it against:
            $this->tableGateway->getAdapter(),
            // the result set to hydrate:
            $resultSetPrototype
        );

        $paginator = new Paginator($paginatorAdapter);
        return $paginator;
    }*/
}