<?php

declare(strict_types=1);

namespace App\Models;

use App\Functions\Connection;
use Exception;
use PDO;

class AdminProduct extends Connection
{

    public function index()
    {
        $sql = "SELECT
            p.id,
            p.nome AS produto,
            p.descricao,
            p.preco,
            p.codigo,
            p.status,
            c.nome AS categoria,
            e.quantidade AS estoque
        FROM produtos p
        INNER JOIN categorias c ON c.id = p.categoria_id
        LEFT JOIN estoque e ON e.produto_id = p.id
        ORDER BY c.nome DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function store(array $data, array $files)
    {
        // verificar se este produto ja existe
        if ($this->checkIfProductsExists($data['codigo'])) {
            $product_exists = "Este produto já existe em estoque.";
            return $product_exists;
        }

        // inserir produto
        $this->pdo->beginTransaction();

        try {
            $sql = "INSERT INTO produtos 
                        (categoria_id, nome, descricao, preco, codigo, status)
                        VALUES (:categoria_id, :nome, :descricao, :preco, :codigo, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":categoria_id" => $data['categoria_id'],
                ":nome" => $data['nome'],
                ":descricao" => $data['descricao'],
                ":preco" => $data['preco'],
                ":codigo" => $data['codigo'],
                ":status" => $data['status']
            ]);

            // insere stoque
            $produto_id = $this->pdo->lastInsertId();

            $sql = "INSERT INTO estoque (produto_id, quantidade) VALUES (:produto_id, :quantidade)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":produto_id" => $produto_id,
                ":quantidade" => $data['quantidade'],
            ]);

            // upload das imagens
            $destino = __DIR__ . "/../../public/assets/images/uploads";

            if (!is_dir($destino)) {
                mkdir($destino, 0777, true);
            }

            foreach ($files['tmp_name'] as $index => $tmp_name) {

                if ($files['error'][$index] !== UPLOAD_ERR_OK) {
                    $upload_image_fail = "Houve um erro ao enviar a imagem.";
                    $this->pdo->rollBack();
                    return $upload_image_fail;
                }

                // peager as extenssões
                $extensions_validate = ['jpg', 'jpeg', 'png'];
                $extension = pathinfo($files['name'][$index], PATHINFO_EXTENSION);
                $extension = strtolower($extension);

                if (!in_array($extension, $extensions_validate)) {
                    $extension_invalid = "A imagem deve ter as extenssões JPG, JPEG ou PNG";
                    $this->pdo->rollBack();
                    return $extension_invalid;
                }

                $image_name = uniqid("prod_", true) . "." . $extension;

                if (!move_uploaded_file($tmp_name, $destino . "/" . $image_name)) {
                    $move_image_fail = "Falha ao salvar a imagem no servidor.";
                    $this->pdo->rollBack();
                    return $move_image_fail;
                }

                $sql = "INSERT INTO imagens_produto (produto_id, imagem, principal)
                        VALUES (:produto_id, :imagem, :principal)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    ":produto_id" => $produto_id,
                    ":imagem" => $image_name,
                    ":principal" => $index === 0 ? 1 : 0
                ]);
            }

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Erro ao cadastrar o produto";
        }
    }

    public function add(string $codigo, int $quantidade)
    {

        $sql = "SELECT id FROM produtos WHERE codigo = :codigo LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":codigo" => $codigo
        ]);
        $id_product = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(!$id_product){
            return false;
        }

        $sql = "SELECT quantidade FROM estoque WHERE produto_id = :produto_id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":produto_id" => $id_product['id']
        ]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$res){
            return false;
        }

        $total = $res['quantidade'] + $quantidade;
        $sql = "UPDATE estoque SET quantidade = $total WHERE produto_id = :produto_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "produto_id" => $id_product['id']
        ]);

        return true;
    }

    public function checkIfProductsExists(string $codigo)
    {
        $sql =  "SELECT * FROM produtos WHERE codigo = :codigo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":codigo" => $codigo
        ]);
        return (bool) $stmt->fetch();
    }

    public function countProduct()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        return $count;
    }

    public function countLowStorege()
    {
        $sql = "SELECT * FROM estoque WHERE quantidade < 5 and quantidade > 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function selectAllCategories()
    {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
}
