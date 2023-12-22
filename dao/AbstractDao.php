<?php

abstract class AbstractDao implements IDao {//todos que forem abstractdao tambem tem que implementar a interface

    protected $conexao = null;

    function __construct(){
        try {
            $this->conexao = Conexao::getConnection();
        } catch (\Throwable $e) {
            throw $e;
        }
    }

}