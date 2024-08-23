<?php

class Query{

    public $results;

    public function __construct(private RecordsGateway $gateway, $sql, ?array $parameters){

        if(!isset($sql)) {
            exit();
        } else {

            $this->results = $this->gateway->getRecords($sql, $parameters);

        }

    }


}

