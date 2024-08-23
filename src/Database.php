<?php

class Database
{
    
    public function __construct(private string $host,
                                private string $name,
                                private string $user,
                                private string $password,
                                private string $charset)
    { }

    public function getConnection(): PDO{
        $dsn = "mysql:host={$this->host};dbname={$this->name};charset={$this->charset}";

        //jeœli dane s¹ konwertowane na string u¿ywamy: 
        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_EMULATE_PREPARES => false, //tutaj wy³¹czamy opcjê, ¿eby ta poni¿ej dzia³a³a
            PDO::ATTR_STRINGIFY_FETCHES => false //tutaj wy³¹czamy konwertowanie danych z bazy na string
        ]);
    }

}
