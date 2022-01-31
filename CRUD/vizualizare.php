<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
header('Location: index.html');
exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1>Catalog Produse</h1>
<p><b>Verificati sctocul inainte de a adauga un produs nou</b</p>
<div class="log_out">
    <a href="logout.php"><i class="fas fa-sign-outalt"></i>Logout</a>
</div>
<?php
// connectare bazadedate
 include("Conectare.php");
// se preiau inregistrarile din baza de date
if ($result = $mysqli->query("SELECT * FROM produse ORDER BY produs_id "))
{ // Afisare inregistrari pe ecran
if ($result->num_rows > 0)
{
// afisarea inregistrarilor intr-o table
echo "<table border='1' cellpadding='10'>";
// antetul tabelului
echo "<tr><th>ID</th><th>Nume Produs</th><th>Pret</th><th>Imagine</th><th>Descriere</th><th>Categorie</th><th>Descriere Completa</th><th>Starea</th><th>Oferta</th><th>Noutati</th></tr>";
while ($row = $result->fetch_object())
{
// definirea unei linii pt fiecare inregistrare
echo "<tr>";
echo "<td>" . $row->produs_id . "</td>";
echo "<td>" . $row->produs_name . "</td>";
echo "<td>" . $row->produs_pret . "</td>";
echo "<td>" . $row->produs_img . "</td>";
echo "<td>" . $row->produs_descriere . "</td>";
echo "<td>" . $row->produs_categ . "</td>";
echo "<td>" . $row->produs_desccompl . "</td>";
echo "<td>" . $row->produs_stare . "</td>";
echo "<td>" . $row->produs_oferta . "</td>";
echo "<td>" . $row->produs_noutati . "</td>";
echo "<td><a href='Modificare.php?id=" . $row->produs_id . "'>Edit</a></td>";
echo "<td><a href='Stergere.php?id=" .$row->produs_id . "'>REMOVE</a></td>";
echo "</tr>";
}
echo "</table>";
}
// daca nu sunt inregistrari se afiseaza un rezultat de eroare
else
{
echo "Nu sunt inregistrari in tabela!";
}
}
// eroare in caz de insucces in interogare
else
{ echo "Error: " . $mysqli->error(); }
// se inchide
$mysqli->close();
?>
<div class="newrecord">
    <form action="Inserare.php">
        <input style='background-color: #008CBA;border: none;color: white;text-align: center;text-decoration: none;font-size: 16px;border-radius: 25px;'type="submit" value="Add new product" />
    </form>
</div>
</body>
</html>