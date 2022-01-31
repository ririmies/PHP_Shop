<?php
// conectare la baza de date database
include("conectare.php");
// se verifica daca id a fost primit
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// preluam variabila 'id' din URL
$id = $_GET['id'];
// stergem inregistrarea cu ib=$id
if ($stmt = $mysqli->prepare("DELETE FROM produse WHERE produs_id = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: Nu se poate executa delete.";
}
$mysqli->close();
echo "<div style = 'color:red;width: 300px; margin: 0 auto; font-family: Elephant;'>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p style='border:solid; width: 300px; text-align: center;position:relative; left:124px; top:2px; background-color:yellow;'><a href=\"Vizualizare.php\">Return to home page</a></p>";
echo "<p style='border:solid; width: 300px; text-align: center;position:relative; left:124px; top:2px; background-color:lightblue;'><a href=\"logout.php\">Logout</a></p>";
?>