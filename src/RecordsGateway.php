<?php

class RecordsGateway{

    private PDO $conn;
    
    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }

    public function getRecords(string $sql, ?array $parameters): array | false {

        $stmt = $this->conn->prepare($sql);

        if(isset($parameters)){
            foreach ($parameters AS $key => $value ){

                if(ctype_digit($value)){
                    $stmt->bindValue(":$key",$value, PDO::PARAM_INT);
                } else {

                    $value_ = htmlentities($value, ENT_QUOTES, 'UTF-8');
                    $stmt->bindValue(":$key",$value_, PDO::PARAM_STR);

                }

            }
        }


        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;

    }

}
