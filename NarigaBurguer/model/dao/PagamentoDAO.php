<?php
    class PagamentoDAO {
    public function create($pagamento){
        try {
            $query = BD::getConexao()->prepare(

                "INSERT INTO pagamento(nome, preco, descricao) 
                VALUES (:n, :p, :d)"
            );
            $query->bindValue(':n', $pagamento->getNome(),PDO::PARAM_STR);
            $query->bindValue(':p', $pagamento->getPreco(),PDO::PARAM_STR);
            $query->bindValue(':d', $pagamento->getDescricao(),PDO::PARAM_STR);



         

            if(!$query->execute()) {
                    print_r($query->errorInfo());
             
        } 
        } 
        
                    catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }
        
        

    
        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM pagamento");
              
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listapagamento = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $pagamento = new Pagamento(); //Classe bean
                    $pagamento->setId($linha['id_pagamento']);
                    $pagamento->setNome($linha['nome']);
                    $pagamento->setPreco($linha['preco']);
                    $pagamento->setDescricao($linha['descricao']);
                   

                    array_push($listapagamento, $pagamento);
                  
                }

                return $listapagamento;

                
            }  
                catch(PDOException $e) {
                echo "Erro #1: " . $e->egtMessage();
            }
       

        }

            public function find($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "SELECT * FROM pagamento WHERE id_pagamento = :i"
                );
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                if($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $pagamento = new pagamento(); // Classe bean
                    $pagamento->setId($linha['id_pagamento']);
                    $pagamento->setNome($linha['nome']);
                    $pagamento->setPreco($linha['preco']);
                    $pagamento->setDescricao($linha['descricao']);
                
                }
                
                return $pagamento;
            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }            
        }

        public function update($pagamento) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE pagamento
                    SET nome = :n, preco = :p, descricao = :d
                    WHERE id_pagamento = :i"
                );
                $query->bindValue(':n', $pagamento->getNome(), PDO::PARAM_STR);
                $query->bindValue(':p', $pagamento->getPreco(), PDO::PARAM_STR);
                $query->bindValue(':d', $pagamento->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':i', $pagamento->getId(), PDO::PARAM_INT);

                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM pagamento
                    WHERE id_pagamento = :i"
                );                
                $query->bindValue(':i', $id, PDO::PARAM_INT);

                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }

    