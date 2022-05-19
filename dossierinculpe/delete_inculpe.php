<?php
    include("../database/config_PDO.php");

if(isset($_GET['id_del_inculpe'])){
$id_inculpe_del = $_GET['id_del_inculpe'];

//Get type inculpation value From table type inculpation and dossierinculpe
$get_inculpation = $bdd->prepare("SELECT inculpation FROM type_inculpation NATURAL JOIN dossierinculpe WHERE id_inculpation='$id_inculpe_del'");
   $get_inculpation->execute();
   $inculpation_data = $get_inculpation->fetch();
   $inculpation_detail = $inculpation_data['inculpation'];

   $url = "student_graduate.php?inculpation_detail=".$inculpation_detail;

//Delete Note From Marks
$delete_inculpe = $bdd->prepare("DELETE FROM `dossierinculpe` WHERE `dossierinculpe`.`id_inculpe` = '$id_inculpe_del'");
   $delete_inculpe->execute();
   
   //header("Location: $url");  
   header("Location: Gradebook.php");  
}

// gradebook_student.php?student_name=
?>