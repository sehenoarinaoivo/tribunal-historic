<?php 
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: ../../login/login.php");
    exit(); 
  }
?>
<?php 
$bdd = new PDO("mysql:host=localhost;dbname=sekoly","root","");
if(isset($_GET['id'])){
    $id=$_GET['id'];
$sql=("DELETE FROM `classe` WHERE id_class='$id'");
 $bdd->exec($sql);
header('location:classes.php');
}
?>