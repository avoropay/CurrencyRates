<?php

namespace Currency\Model;

/**
 * Class Currency
 * @package Currency\Model
 *   `date` varchar(10) NOT NULL,
    `digital_code` varchar(3) NOT NULL,
    `letter_code` varchar(3) NOT NULL,
    `number_of_units` int(11) NOT NULL,
    `currency_name` varchar(50) NOT NULL,
    `exchange_rate` decimal(20,4) NOT NULL
 */


class Currency
{
    public $date;
    public $digital_code;
    public $letter_code;
    public $number_of_units;
    public $currency_name;
    public $exchange_rate;

    public function exchangeArray(array $data)
    {
        $this->date     = !empty($data['date']) ? $data['date'] : null;
        $this->digital_code = !empty($data['digital_code']) ? $data['digital_code'] : null;
        $this->letter_code  = !empty($data['letter_code']) ? $data['letter_code'] : null;
        $this->number_of_units  = !empty($data['number_of_units']) ? $data['number_of_units'] : null;
        $this->currency_name  = !empty($data['currency_name']) ? $data['currency_name'] : null;
        $this->exchange_rate  = !empty($data['exchange_rate']) ? $data['exchange_rate'] : null;
    }
}