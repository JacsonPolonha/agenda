<?php

class ContatoDao extends AbstractDao {

    public function inserir($obj){
        $sql = "INSERT INTO Contato (ContatoNome, UserID) VALUES (?,?)";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $obj->getNome(), PDO::PARAM_STR);
        $st->bindValue(2, $obj->getUsuario()->getID(), PDO::PARAM_INT);
        $st->execute();
    }

    public function selecionar($id){
        throw new Exception("Utilize o método detalhe");
    }

    public function detalhe($id, $usuario){
        $contato = null;
        $sql = "SELECT * FROM Contato WHERE ContatoID = ? and UserID = ?";

        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $id, PDO::PARAM_STR);
        $st->bindValue(2, $usuario->getId(), PDO::PARAM_INT);
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $st->execute();
        $reg = $st->fetch();

        if(!empty($reg)){
            $contato = new Contato($usuario);
            $contato->setId($reg["ContatoID"]);
            $contato->setNome($reg["ContatoNome"]);

            //Telefones
            $sql = "SELECT * FROM Telefone WHERE ContatoID = ?";
            $stTelefone = $this->conexao->prepare($sql);
            $stTelefone->bindValue(1, $contato->getId(), PDO::PARAM_INT);
            $stTelefone->execute();
            
            while($regTelefone = $stTelefone->fetch(PDO::FETCH_ASSOC)){
                $telefone = new Telefone;
                $telefone->setId($regTelefone["TelID"]);
                $telefone->setNumero($regTelefone["TelNumero"]);
                $contato->adicionarTelefone($telefone);
            }

            //Emails
            $sql = "SELECT *FROM Email WHERE ContatoID = ?";
            $stEmail = $this->conexao->prepare($sql);
            $stEmail->bindValue(1, $contato->getId(), PDO::PARAM_INT);
            $stEmail->execute();

            while($regEmail = $stEmail->fetch(PDO::FETCH_ASSOC)){
                $email = new Email;
                $email->setId($regEmail["EmailID"]);
                $email->setEndereco($regEmail["EmailEnd"]);
                $contato->adicionarEmail($email);
            }

        }
        return $contato;
    }

    public function atualizar($obj){
        $sql = "UPDATE Contato SET ContatoNome = ? WHERE ContatoID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $obj->getNome(), PDO::PARAM_STR);
        $st->bindValue(2, $obj->getId(), PDO::PARAM_INT);
        $st->execute();
    }

    public function excluir($id){
        $sql = "DELETE FROM Contato WHERE ContatoID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $id, PDO::PARAM_INT);
        $st->execute();
    }

    public function listarTodos(){
        throw new Exception("Utilize o método listar");
    }

    public function listar($usuario){
        $lista = [];

        $sql = "SELECT * FROM Contato WHERE UserID = ? ORDER BY ContatoNome";

        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $usuario->getId(), PDO::PARAM_INT);
        $st->execute();

        while($reg = $st->fetch(PDO::FETCH_ASSOC)){
            $contato = new Contato($usuario);
            $contato->setId($reg["ContatoID"]);
            $contato->setNome($reg["ContatoNome"]);

            //Telefones
            $sql = "SELECT * FROM Telefone WHERE ContatoID = ?";
            $stTelefone = $this->conexao->prepare($sql);
            $stTelefone->bindValue(1, $contato->getId(), PDO::PARAM_INT);
            $stTelefone->execute();
            
            while($regTelefone = $stTelefone->fetch(PDO::FETCH_ASSOC)){
                $telefone = new Telefone;
                $telefone->setId($regTelefone["TelID"]);
                $telefone->setNumero($regTelefone["TelNumero"]);
                $contato->adicionarTelefone($telefone);
            }

             //Emails
             $sql = "SELECT *FROM Email WHERE ContatoID = ?";
             $stEmail = $this->conexao->prepare($sql);
             $stEmail->bindValue(1, $contato->getId(), PDO::PARAM_INT);
             $stEmail->execute();
 
             while($regEmail = $stEmail->fetch(PDO::FETCH_ASSOC)){
                 $email = new Email;
                 $email->setId($regEmail["EmailID"]);
                 $email->setEndereco($regEmail["EmailEnd"]);
                 $contato->adicionarEmail($email);
             }

             $lista[] = $contato;
        }

        return $lista;
    }

    public function excluirEmail($id){
        $sql = "DELETE FROM Email WHERE EmailID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $id, PDO::PARAM_INT);
        $st->execute();
    }

    public function excluirTelefone($id){
        $sql = "DELETE FROM Telefone WHERE TellID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $id, PDO::PARAM_INT);
        $st->execute();
    }

    public function atualizarTelefone($obj){
        $sql = "UPDATE Telefone SET TelNumero = ? WHERE TelID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $obj->getNumero(), PDO::PARAM_STR);
        $st->bindValue(2, $obj->getId(), PDO::PARAM_INT);
        $st->execute(); 
    }

    public function atualizarEmail($obj){
        $sql = "UPDATE Email SET EmailEnd = ? WHERE EmailID = ?";
        $st = $this->conexao->prepare($sql);
        $st->bindValue(1, $obj->getEndereco(), PDO::PARAM_STR);
        $st->bindValue(2, $obj->getId(), PDO::PARAM_INT);
        $st->execute(); 
    }

}