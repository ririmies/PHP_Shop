<?php
require_once "DBController.php";
class ShoppingCart extends DBController
{
 function getAllProduct()
 {
 $query = "SELECT * FROM produse";

 $productResult = $this->getDBResult($query);
 return $productResult;
 }
 function getMemberCartItem($member_id)
 {
 $query = "SELECT produse.*, cos.cos_id, cos.cos_cantitate FROM produse, cos WHERE produse.produs_id = cos.cos_produsID AND cos.cos_clientID = ?";
 $params = array(array(
 "param_type" => "i",
 "param_value" => $member_id
 )
 );
 $cartResult = $this->getDBResult($query, $params);
 return $cartResult;
 }
 function getProductByCode($product_code)
 {
 $query = "SELECT * FROM produse WHERE produs_id=?";

 $params = array(
 array(
 "param_type" => "s",
 "param_value" => $product_code
 )
 );
 $productResult = $this->getDBResult($query, $params);
 return $productResult;
 }
 function getCartItemByProduct($product_id, $member_id)
 {
 $query = "SELECT * FROM cos WHERE cos_produsID = ? AND cos_clientID = ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $product_id
 ),
 array(
 "param_type" => "i",
 "param_value" => $member_id
 )
 );
 $cartResult = $this->getDBResult($query, $params);
 return $cartResult;
 }
 function addToCart($product_id, $quantity, $member_id)
 {
 $query = "INSERT INTO cos (cos_produsID,cos_cantitate,cos_clientID) VALUES (?, ?, ?)";
 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $product_id
 ),
 array(
 "param_type" => "i",
 "param_value" => $quantity
 ),
 array(
 "param_type" => "i",
 "param_value" => $member_id
 )
 );

 $this->updateDB($query, $params);
 }
 function updateCartQuantity($quantity, $cart_id)
 {
 $query = "UPDATE cos SET cos_cantitate = ? WHERE cos_id= ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $quantity
 ),
 array(
 "param_type" => "i",
 "param_value" => $cart_id
 )
 );
 $this->updateDB($query, $params);
 }
 function deleteCartItem($cart_id)
 {
 $query = "DELETE FROM cos WHERE cos_id = ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $cart_id
 )
 );

 $this->updateDB($query, $params);
 }
 function emptyCart($member_id)
 {
 $query = "DELETE FROM cos WHERE cos_clientID = ?";

 $params = array(
 array(
 "param_type" => "i",
 "param_value" => $member_id
 )
 );

 $this->updateDB($query, $params);
 }

 function plasareComanda ($detalii_comanda,$client_id){
     $query = "SELECT comandanumar FROM ordin ORDER BY ordin_id DESC";

     $orderResult = $this->getDBResult($query);

     if (empty($orderResult)){
         $comandanumar = '1';
     }
     else{
         $comandanumar = $orderResult[0]['comandanumar'] + 1;
     }

     foreach ($detalii_comanda as $comanda){
         $query = 'INSERT INTO ordin (ordin_prodID, ordin_cantit, ordin_client_id, ordin_stare, comandanumar, ordin_dataintr, ordin_shipdate) VALUE (?,?,?,?,?,?,?)';

         $params = array(
             array(
                 "param_type" => "i",
                 "param_value" => $comanda['produs_id']
             ),
             array(
                 "param_type" => "i",
                 "param_value" => $comanda['cos_cantitate']
             ),
             array(
                 "param_type" => "i",
                 "param_value" => $client_id
             ),
             array(
                 "param_type" => "i",
                 "param_value" => "In Progress"
             ),
             array(
                 "param_type" => "i",
                 "param_value" => $comandanumar
             ),
              array(
                  "param_type" => "",
                  "param_value" => date('Y-m-d H:i:s')
              ),
             array(
                 "param_type" => "d",
                 "param_value" => strtotime(date('Y-m-d H:i:s') . ' + 10 days')
             )
         );
         $this->updateDB($query, $params);
     }

 }

}
