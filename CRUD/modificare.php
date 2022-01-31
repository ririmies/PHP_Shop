<?php // connectare bazadedate
include("Conectare.php");
//Modificare datelor
// se preia id din pagina vizualizare
$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{ // verificam daca id-ul din URL este unul valid
if (is_numeric($_POST['id']))
{ // preluam variabilele din URL/form
$id = $_POST['id'];
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
$imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
$price = htmlentities($_POST['price'], ENT_QUOTES);
$descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
$categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
$desccompl = htmlentities($_POST['Desccompl'], ENT_QUOTES);
$stare = htmlentities($_POST['stare'], ENT_QUOTES);
$oferta = htmlentities($_POST['oferta'], ENT_QUOTES);
$noutati = htmlentities($_POST['noutati'], ENT_QUOTES);
// verificam daca numele, prenumele, an si grupa nu sunt goale
if ($nume == '' || $id == ''||$imagine==''||$price==''||$descriere==''||$categorie==''||$desccompl==''||$stare==''||$stare==''||$oferta==''||$noutati=='')
{ // daca sunt goale afisam mesaj de eroare
echo "<div> ERROR: Completati campurile obligatorii!</div>";
}else
{ // daca nu sunt erori se face update name, code, image, price, descriere, categorie
if ($stmt = $mysqli->prepare("UPDATE produse SET produs_name=?,produs_pret=?,produs_img=?,produs_categ=?, produs_descriere=?, produs_desccompl=?, produs_stare=?, produs_oferta=?, produs_noutati=? WHERE produs_id='".$id."'"))
{
$stmt->bind_param("sdsssssii", $nume, $price, $imagine, $categorie, $descriere, $desccompl, $stare, $oferta, $noutati);
$stmt->execute();
$stmt->close();
header('Location: vizualizare.php');
 }// mesaj de eroare in caz ca nu se poate face update
else
{echo "ERROR: nu se poate executa update.";}
}
}
// daca variabila 'id' nu este valida, afisam mesaj de eroare
else
{echo "id incorect!";} }}?>
<html> <head><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<link href="style.css" type="text/css" rel="stylesheet" />
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<?php if ($_GET['id'] != '') { ?>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<p>ID: <?php echo $_GET['id'];
if ($result = $mysqli->query("SELECT * FROM produse where produs_id='".$_GET['id']."'"))
{
if ($result->num_rows > 0)
{ $row = $result->fetch_object();?></p>
<strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->produs_name;?>"/><br/>
<strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo$row->produs_img;?>"/><br/>
<strong>Price: </strong> <input type="text" name="price" value="<?php echo$row->produs_pret; ?>"/><br/>
<strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo$row->produs_descriere; ?>"/><br/>
<strong>Categorie: </strong> <input type="text" name="categorie" value="<?php echo $row->produs_categ;?>"/><br/>
<strong>desccompl: </strong> <input type="text" name="Desccompl" value="<?php echo $row->produs_desccompl;?>"/><br/>
<strong>Stare: </strong> <input type="text" name="stare" value="<?php echo $row->produs_stare;?>"/><br/>
<strong>Oferta: </strong> <input type="text" name="oferta" value="<?php echo $row->produs_oferta;?>"/><br/>
<strong>Noutati: </strong> <input type="text" name="noutati" value="<?php echo $row->produs_noutati;}}}?>"/><br/>
<br/>
    <div class="home">
        <div class="btn">
            <input style='background-color: #008CBA;border: none;color: white;text-align: center;padding: 6px 45px;text-decoration: none;font-size: 16px;border-radius: 25px;'type="submit" name="submit" value="Modify" />
        </div>
        <div class="lk">
            <a href="Vizualizare.php">Home page</a>
        </div>
</div></form></body> </html>