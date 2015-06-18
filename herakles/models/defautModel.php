<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of defautModel
 *
 * @author autin
 */
class defautModel extends Exception {
    
    
    private function getBdd(){
        
    $bdd = new PDO('mysql:host=localhost;dbname=herakles;charset=utf8', 'root',
      '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
    
  }
    
    
    public function getCustomers(){
        $bdd = $this->getBDD();
        $customers = $bdd->prepare('select * from customer');
        $customers->execute();
        if ($customers->rowCount() > 0)
             return $customers->fetchAll(PDO::FETCH_ASSOC);
      
    }
    
    
    public function getCustomerInfo($id){
        $bdd = $this->getBDD();
        $customer = $bdd->prepare('select * from customer where id='.$id);
        $customer->execute();
        if ($customer->rowCount() > 0)
            return $customer->fetch(PDO::FETCH_ASSOC);
        else
            throw new Exception("Aucun compte client avec cet id en base de donnée");
    }
    
    public function updateCustomer(array $data){

        $customerMail = $data['customerMail'];
        $customerName = $data['customerName'];
        $streetName = $data['streetName'];
        $zipNumber = $data['zipNumber'];
        $cityName = $data['cityName'];
        $customerId = $data['customerId'];
        $customerTel = $data['customerTel'];
        
        var_dump($customerTel);
        
        $bdd = $this->getBDD();
        $update = $bdd->prepare('UPDATE customer SET `raison_sociale` = :raison_sociale, `rue` = :rue , `code_postale` = :code_postale ,ville = :ville, contact = :contact, `contact_tel` = :contact_tel WHERE id = :id');
        $update->bindParam(':raison_sociale', $customerName);
        $update->bindParam(':rue', $streetName);
        $update->bindParam(':code_postale', $zipNumber);
        $update->bindParam(':ville', $cityName);
        $update->bindParam(':contact', $customerMail);
        $update->bindParam(':id',$customerId);
        $update->bindParam(':contact_tel',$customerTel);
        $update->execute();
    }
    
    public function deleteCustomer($customerId){
        $bdd = $this->getBdd();
        $id = $customerId[0];
        $delete = $bdd->prepare('DELETE FROM customer WHERE id = :id');
        $delete->bindParam(':id', $id);
        $delete->execute();
    }
    
    public function addCustomer($data){
        
        $customerMail = $data['customerMail'];
        $customerName = $data['customerName'];
        $streetName = $data['streetName'];
        $zipNumber = $data['zipNumber'];
        $cityName = $data['cityName'];
        $customerTel = $data['customerTel'];
        
        $bdd = $this->getBdd();
        $insert = $bdd->prepare("INSERT INTO customer (raison_sociale,rue,code_postale, ville, contact, contact_tel) VALUES (:raison_sociale, :rue, :code_postale, :ville, :contact, :contact_tel)");
        $insert->bindParam(':raison_sociale', $customerName);
        $insert->bindParam(':rue', $streetName);
        $insert->bindParam(':code_postale', $zipNumber);
        $insert->bindParam(':ville', $cityName);
        $insert->bindParam(':contact', $customerMail);
        $insert->bindParam(':contact_tel', $customerTel);
        $insert->execute();
    }
    
    public function exportCustomers(){

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=customers.csv');
 
            $output = "raison_sociale,rue,code_postal,ville, contact, contact_tel \n";
            // select all members
            $bdd = $this->getBdd();
            $sql = $bdd->query('SELECT * FROM customer ORDER BY id ASC');
            $list = $sql->fetchAll();
                    foreach ($list as $rs) {
                        // add new row
                        $output .= $rs['raison_sociale'].",".$rs['rue'].",".$rs['code_postale'].",".$rs['ville'].",".$rs['contact'].",".$rs['contact_tel']."\n";
                    }
                    // export the output
                    echo $output;
                    exit;
    }
    
    
    public function getHistory($idcustomer){
        $idcustomer = $idcustomer[0];
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT * FROM order_histo LEFT JOIN customer ON order_histo.id_customer = customer.id JOIN status ON order_histo.id_status = status.id WHERE order_histo.id_customer = :id");
        $req->bindValue(':id', $idcustomer);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCustomersByProduct($productId){
        
        $id = $productId[0];
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT * FROM customer LEFT JOIN order ON order_product.id_order = order.id LEFT JOIN customer ON order.id_customer = customer.id WHERE order_product.id_product = :id");
        $req->bindValue(':id', $id);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } 

}

?>
