<?php

namespace Exchange\Form;

use Zend\Form\Form;

class ExchangeForm  extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('Exchange');

        $Currency_options = array(
          'european' => array(
            'label' => 'Popular:',
            'options' => array(
              "USD" => "USD - US dollar",
              "EUR"=> "EUR - euro",
              "RUB"=>"RUB - russian ruble",
              "GBP"=>"GBP - british pound",
              "CHF"=>"CHF - swiss franc",
              "PLN"=>"PLN - polish zloty",
              "JPY"=>"JPY - japanese yen",
              "UAH"=>"UAH - ukrainian hryvnia",
              "CAD"=>"CAD - canadian dollar",
              "AUD"=>"AUD - australian dollar"
            ),
          ),
          'asian' => array(
            'label' => 'Other:',
            'options' => array(
              "HNL"=>"HNL - honduras lempira",
              "HKD"=>"HKD - hong kong dollar",
              "HUF"=>"HUF - hungarian forint",
              "ISK"=>"ISK - iceland krona",
              "INR"=>"INR - indian rupee"),
          )
        );
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'i_give',
            'type' => 'Select',
            'options' => [
                'label' => 'I Give:',
                'value_options' => $Currency_options
            ],
        ]);
        $this->add([
            'name' => 'i_want',
            'type' => 'Select',
            'options' => [
                'label' => 'I Want:',
                'value_options' => $Currency_options
            ],
        ]);

        $this->add([
          'name' => 'amount_to_give',
          'type' => 'text',
          'options' => [
            'label' => 'How much to give:',
            'value_options' => $Currency_options
          ],
        ]);
        $this->add([
          'name' => 'amount_to_get',
          'type' => 'text',
          'options' => [
            'label' => 'How much to get:',
            'value_options' => $Currency_options
          ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}