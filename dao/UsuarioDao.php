<?php

class UsuarioDao extends AbstractDao {

    public function inserir($obj){

    }

    public function selecionar($id){

    }

    public function listarTodos(){

        $lista = [];
        $sql = "SELECT * FROM Usuario";
        $rs = $this->conexao->query($sql);

        while ($reg = $rs->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario;
            $usuario->setId($reg["UserId"]);
            $usuario->setNome($reg["UserNome"]);
            $usuario->setEmail($reg["UserEmail"]);
            $usuario->setLogin($reg["UserLogin"]);

            $lista[] = $usuario;
        }


        return $lista;

    }

    public function atualizar($obj){

    }

    public function excluir($id){
        
    }

}