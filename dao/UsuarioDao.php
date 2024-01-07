<?php

class UsuarioDao extends AbstractDao {

    public function inserir($obj){
        $sql = "INSERT INTO Usuario (UserNome, UserEmail, UserLogin, UserSenha) VALUES (?, ?, ?, ?)";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $obj->getNome(), PDO::PARAM_STR);
        $st->bindValue(2, $obj->getEmail(), PDO::PARAM_STR);
        $st->bindValue(3, $obj->getLogin(), PDO::PARAM_STR);
        $st->bindValue(4, $obj->getSenha(), PDO::PARAM_STR);

        $st->execute();
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
        $sql = "DELETE FROM Usuario WHERE UserID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $id, PDO::PARAM_INT);
        $st->execute();
    }

    public function login($login, $senha){
        $sql = "SELECT * FROM Usuario WHERE UserLogin = ? and UserSenha = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $login, PDO::PARAM_STR);
        $st->bindValue(2, $senha, PDO::PARAM_STR);
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $st->execute();
        $rs = $st->fetch();

        $usuario = null;

        if(!empty($rs)){
            $usuario = new Usuario;
            $usuario->setId($rs["UserID"]); //Talvez seja D em maiusculo
            $usuario->setNome($rs["UserNome"]); 
            $usuario->setEmail($rs["UserEmail"]); 
            $usuario->setLogin($rs["UserLogin"]); 
        }
        return $usuario;
    }

}