<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductModel
 *
 * @author autin
 */
class ProductModel extends Exception{
    
    private $tva = 20; 
    
    private function getBdd(){
        
    $bdd = new PDO('mysql:host=localhost;dbname=herakles;charset=utf8', 'root',
      '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
    
  }
    
    public function getProducts(){
        
        $bdd = $this->getBDD();
        $products = $bdd->prepare('select product.id, product.name_product, product.price, product.stock, product.description, category.name_category from product JOIN category ON product.id_type = category.id');
        $products->execute();
        if ($products->rowCount() > 0)

        $products = $products->fetchAll(PDO::FETCH_ASSOC);
        
        for($i=0;$i < count($products);$i++){
            
            $priceTTC = $this->calculeTVA($products[$i]['price']);
            $products[$i]['price_TTC'] = $priceTTC;
            
        }

         return $products;
    }
    
      public function calculeTVA($price){
              
      $TTC = $price * (1 + $this->tva/100);
      return $TTC;
  }
  
    
    
     public function getProductInfo($id){
        $bdd = $this->getBDD();
        $product = $bdd->prepare('select * from product where id='.$id);
        $product->execute();
        if ($product->rowCount() > 0)
            return $product->fetch(PDO::FETCH_ASSOC);
        else
            throw new Exception("Aucun compte client avec cet id en base de donnée");
    }
    
    public function updateProduct(array $data){

        $productName = $data['productName'];
        $productDescription = $data['productDescription'];
        $productPrice = $data['productPrice'];
        $productStock = $data['productStock'];
        $productCategory = $data['productCategory'];
        $productId = $data['productId'];
    
        $bdd = $this->getBDD();
        $update = $bdd->prepare('UPDATE product SET `name_product` = :name, `description` = :description , `price` = :price ,stock = :stock, id_type = :category WHERE id = :id');
        $update->bindParam(':name', $productName);
        $update->bindParam(':description', $productDescription);
        $update->bindParam(':price', $productPrice);
        $update->bindParam(':stock', $productStock);
        $update->bindParam(':id',$productId);
        $update->bindParam(':category',$productCategory);
        $update->execute();
    }
    
     public function deleteProduct($productId){
        $bdd = $this->getBdd();
        $id = $productId[0];
        $delete = $bdd->prepare('DELETE FROM product WHERE id = :id');
        $delete->bindParam(':id', $id);
        $delete->execute();
    }
    
    public function addProduct($data){
        
        extract($data);
        $productName = $data['productName'];
        $productDescription = $data['productDescription'];
        $productPrice = $data['productPrice'];
        $productStock = $data['productStock'];
        $productCategory = $data['productCategory'];
        $bdd = $this->getBdd();
        $insert = $bdd->prepare("INSERT INTO product (name_product ,price,stock, description, id_type) VALUES (:name, :price, :stock, :description, :category)");
        $insert->bindParam(':name', $productName);
        $insert->bindParam(':description', $productDescription);
        $insert->bindParam(':price', $productPrice);
        $insert->bindParam(':stock', $productStock);
        $insert->bindParam(':category', $productCategory);
        $insert->execute();
    }
    
    public function addCategory($data){  
        extract($data);
        $categoryName = $data['categoryName'];
        $bdd = $this->getBdd();
        $insert = $bdd->prepare("INSERT INTO category (name_category) VALUES (:name)");
        $insert->bindParam(':name', $categoryName);
        $insert->execute();  
    }
    
    public function deleteCategory($categoryId){
        $bdd = $this->getBdd();
        $id = $categoryId[0];
        $delete = $bdd->prepare('DELETE FROM category WHERE id = :id');
        $delete->bindParam(':id', $id);
        $delete->execute();
    }
    
     public function getCategorys(){
        
        $bdd = $this->getBDD();
        $categorys = $bdd->prepare('select * from category');
        $categorys->execute();
        if ($categorys->rowCount() > 0)
             return $categorys->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getCategory($categoryId){
        $id = $categoryId[0]; 
        
        var_dump($id);
        $bdd = $this->getBDD();
        $getCat = $bdd->prepare('select * from category WHERE id = :id');
        $getCat->bindParam(':id', $id);
        $getCat->execute();
        return $getCat->fetchAll(PDO::FETCH_ASSOC);
    }
    
     public function updateCategory(array $data){

        $data = extract($_POST);
        $bdd = $this->getBDD();
        $update = $bdd->prepare('UPDATE category SET `name_category` = :name WHERE id = :id');
        $update->bindParam(':name', $categoryName);
        $update->bindParam(':id',$categoryId);
        $update->execute();
    }
    
    
    
    
    
    
}

?>
