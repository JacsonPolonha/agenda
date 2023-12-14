<?php

class Conexao {
    private static $conexao = null;

    private function __construct()
    {
        
    }

    static function getConnection(){
        if(!isset(self::$conexao)){
            self::$conexao = new PDO('mysql:host=localhost', 'root', '');
        }
        return self::$conexao;
    }
    //por ser estatico ao inves de dinamico, não usa o $this e sim o self::
    //static por que a conexão não vai ter alteração, 


    function __clone()
    {
        throw new Exception('Singleton não pode ser clonado');
    }
}