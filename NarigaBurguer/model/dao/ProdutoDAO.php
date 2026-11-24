<?php
    class ProdutoDAO {
    public function create($produto){
        try {
            $query = BD::getConexao()->prepare(

                "INSERT INTO produto(nome, preco, descricao) 
                VALUES (:n, :p, :d)"
            );
            $query->bindValue(':n', $produto->getNome(),PDO::PARAM_STR);
            $query->bindValue(':p', $produto->getPreco(),PDO::PARAM_STR);
            $query->bindValue(':d', $produto->getDescricao(),PDO::PARAM_STR);



         

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
                $query = BD::getConexao()->prepare("SELECT * FROM produto");
              
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                $listaproduto = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $produto = new Produto(); //Classe bean
                    $produto->setId($linha['id_produto']);
                    $produto->setNome($linha['nome']);
                    $produto->setPreco($linha['preco']);
                    $produto->setDescricao($linha['descricao']);
                   

                    array_push($listaproduto, $produto);
                  
                }

                return $listaproduto;

                
            }  
                catch(PDOException $e) {
                echo "Erro #1: " . $e->egtMessage();
            }
       

        }

            public function find($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "SELECT * FROM produto WHERE id_produto = :i"
                );
                $query->bindValue(':i', $id, PDO::PARAM_INT);
                
                if(!$query->execute()) {
                    print_r($query->errorInfo());
                }

                if($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                    $produto = new produto(); // Classe bean
                    $produto->setId($linha['id_produto']);
                    $produto->setNome($linha['nome']);
                    $produto->setPreco($linha['preco']);
                    $produto->setDescricao($linha['descricao']);
                
                }
                
                return $produto;
            } 
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }            
        }

        public function update($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE produto
                    SET nome = :n, preco = :p, descricao = :d
                    WHERE id_produto = :i"
                );
                $query->bindValue(':n', $produto->getNome(), PDO::PARAM_STR);
                $query->bindValue(':p', $produto->getPreco(), PDO::PARAM_STR);
                $query->bindValue(':d', $produto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':i', $produto->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM produto
                    WHERE id_produto = :i"
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

    