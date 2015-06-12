<?php

require_once ROOT.'core/Controller.php';
require ROOT.'core/App.php';



/* création du trigger : 

CREATE TRIGGER before_update_order
BEFORE UPDATE ON `order` FOR EACH ROW
  BEGIN
    SET NEW.version = OLD.version + 1;
    INSERT INTO `order_histo`
      (id_order_original, id_customer, date_add, date_edit, id_status, action, date_action, version)
    VALUES
      (OLD.id, OLD.id_customer, OLD.date_add, OLD.date_edit, OLD.id_status,'update', NOW(), OLD.version);
  END;

CREATE TRIGGER before_update_order_product
BEFORE INSERT ON `order_product` FOR EACH ROW
	BEGIN
    SET NEW.version = OLD.version + 1;
     INSERT INTO `order_product_histo`
    (id_order,id_product,quantity,version)
    VALUES
    (OLD.id_order, OLD.id_product, OLD.quantity,OLD.version);
 	END; 
    
 */

  
?>
