<?php
include("conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
$nume = htmlentities($_POST['nume'], ENT_QUOTES);
$price = htmlentities($_POST['price'], ENT_QUOTES);
$imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
$categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
$descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
$desccompl = htmlentities($_POST['desccompl'], ENT_QUOTES);
$stare = htmlentities($_POST['stare'], ENT_QUOTES);
$oferta = htmlentities($_POST['oferta'], ENT_QUOTES);
$noutati = htmlentities($_POST['noutati'], ENT_QUOTES);

// verificam daca sunt completate
if ($nume == '' ||$price==''||$imagine==''||$categorie==''||$descriere==''||$desccompl == ''||$stare==''||$oferta==''||$noutati=='')
{
// daca sunt goale se afiseaza un mesaj
$error = 'ERROR: All Fields are mandatory!';
} else {
// insert
if ($stmt = $mysqli->prepare("INSERT into produse (produs_name, produs_pret, produs_img, produs_categ, produs_descriere, produs_desccompl, produs_stare, produs_oferta, produs_noutati) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"))
{
$stmt->bind_param("sdsssssii", $nume, $price, $imagine, $categorie, $descriere,$desccompl,$stare,$oferta,$noutati);
$stmt->execute();
$stmt->close();
header('Location: vizualizare.php');
}
// eroare le inserare
else
{
echo "ERROR: Nu se poate executa insert.";
}
}
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head> <body>
<h1><?php echo "Adaugare produs"; ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div class="product_record">
<strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>

<strong>Imagine: </strong> <input type="text" name="imagine" value=""/><br/>

<strong>Pret: </strong> <input type="text" name="price" value=""/><br/>

<strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>

<strong>Categorie: </strong> <input type="text" name="categorie" value=""/><br/>

<strong>Descriere completa: </strong> <input type="text" name="desccompl" value=""/><br/>

<strong>Stare: </strong> <input type="text" name="stare" value=""/><br/>

<strong>Oferta: </strong> <input type="text" name="oferta" value=""/><br/>

<strong>Noutati: </strong> <input type="text" name="noutati" value=""/><br/>

<br/>
<div class="home">
    <div class="btn">
    <input style='background-color: #008CBA;border: none;color: white;text-align: center;padding: 6px 45px;text-decoration: none;font-size: 16px;border-radius: 25px;'type="submit" name="submit" value="Add" />
    </div>
    <div class="lk">
    <a href="Vizualizare.php">Home page</a>
</div>
</div>
</div></form></body></html>
