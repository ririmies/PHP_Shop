<?php
require_once "ShoppingCart.php";
session_start();
// Dacă utilizatorul nu este conectat redirecționează la pagina de autentificare ...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
// pt membrii inregistrati
$member_id=$_SESSION['id'];

$shoppingCart = new ShoppingCart();

$cartItem = $shoppingCart->getMemberCartItem($member_id);

$shoppingCart->plasareComanda($cartItem,$member_id);

$shoppingCart->emptyCart($member_id);
?>
<HTML>
<HEAD>
<TITLE>Comanda Plasata</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div class="alert">
    <a href="magazin.php" class="closebtn">&times</>
    <strong>Felicitari!!! </strong> Comanda a fost plasata cu succes .
</div>
</BODY>
</HTML>



