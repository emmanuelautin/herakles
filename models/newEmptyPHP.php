<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   $insert = $bdd->prepare('insert into order (id_customer,date_add,date_edit,id_status) VALUES (:id_customer,:date_add,:date_edit,:id_status)');
        
        $sql = 'INSERT INTO `order` (id_customer, date_add, date_edit, id_status) VALUES ('.$customerId.','.$dateAdd.','.$dateEdit.', '.$status.')';
               var_dump($sql);
        $bdd->query($sql);