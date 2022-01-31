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
$ascundeButon = false;


if (! empty($_GET["action"])) {
 switch ($_GET["action"]) {
 case "add":
 if (! empty($_POST["quantity"])) {

 $productResult = $shoppingCart->getProductByCode($_GET["code"]);
 $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["produs_id"], $member_id);


 if (! empty($cartResult)) {
 // Modificare cantitate in cos
 $newQuantity = $cartResult[0]["cos_cantitate"] + $_POST["quantity"];
 $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["cos_produsID"]);
 } else {
 // Adaugare in tabelul cos
 $shoppingCart->addToCart($productResult[0]["produs_id"], $_POST["quantity"], $member_id);
 }
 }
 break;
 case "remove":
 // Sterg o sg inregistrare
 $shoppingCart->deleteCartItem($_GET["id"]);
 $cartItem = $shoppingCart->getMemberCartItem($member_id);
 if (empty($cartItem)){
     $ascundeButon = true;
 }
 break;
 case "empty":
 // Sterg cosul
 $shoppingCart->emptyCart($member_id);
 header('Location: magazin.php');
 break;
 }
}
?>
<HTML>
<HEAD>
<TITLE>Cos cumparaturi</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
 <div id="shopping-cart">
 <div class="txt-heading">
 <div class="txt-heading-label">Cos Cumparaturi</div> <a
id="btnEmpty" href="cos.php?action=empty"><img src="product-images/cart.png"
alt="empty-cart" title="Empty Cart" /></a>
 </div>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
if (! empty($cartItem)) {
 $item_total = 0;
 ?>
<table cellpadding="10" cellspacing="1">
 <tbody>
 <tr>
 <th style="text-align: left;"><strong>Name</strong></th>
 <th style="text-align: left;"><strong>Code</strong></th>
 <th style="text-align:
right;"><strong>Quantity</strong></th>
 <th style="text-align:
right;"><strong>Price</strong></th>
 <th style="text-align:
center;"><strong>Action</strong></th>
 </tr>
<?php
 foreach ($cartItem as $item) {
 ?>
<tr>
 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["produs_name"]; ?></strong></td>
 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["produs_id"]; ?></td>
 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cos_cantitate"]; ?></td>
 <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo "$".$item["produs_pret"]; ?></td>
 <td style="text-align: center; border-bottom: #F0F0F0 1px solid;">
    <a href="Cos.php?action=remove&id=<?php echo $item["cos_id"]; ?>" class="btnRemoveAction"><img src="product-images/delete.png" alt="icon-delete" title="Remove Item" /></a></td>
 </tr>
<?php
 $item_total += ($item["produs_pret"] * $item["cos_cantitate"]);
 }
 ?>
<tr>
 <td colspan="3"
align=right><strong>Total:</strong></td>
 <td align=right><?php echo "$".$item_total; ?></td>
 <td></td>
 </tr>
 </tbody>
 </table>
 <?php
}
?>
</div>
 <div class="meniu_cos">
<div class="continua"><a href="magazin.php">Continua cumparaturile</a></div>
 <div class="comanda"><?=$ascundeButon ? "<span>Plaseaza comanda</span>" : "<a href='PlasareComanda.php'>Plaseaza comanda</a>"?></div>
<div class="exit"><a href="logout.php">Logout</a></div>
 </div>
</BODY>
</HTML>
