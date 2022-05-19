<?php 
/*session_start();
if(!isset($_SESSION["admin"])){
    header("Location: ../../login/login.php");
    exit(); 
  }*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
    include("../database/config_PDO.php");   //connection bdd...
    include("../database/config_procedural.php"); //CONNECT DATA...
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" href="/images/favicon.png">
    <title> students Graduate </title>
    <link media="all" type="text/css" rel="stylesheet" href="Gradebook_files/bootstrap.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link media="all" type="text/css" rel="stylesheet" href="Gradebook_files/bootstrap-theme.min.css">
    <!-- ../1students/students_files -->
    <!-- <link media="all" type="text/css" rel="stylesheet" href="../1students/students_files/font-awesome.css"> -->
    <script src="Gradebook_files/jquery-1.11.3.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="Gradebook_files/style.css"> 
  </head>

<body>
  <div class="navbar navbar-default panel-nav">

        <div class="container-fluid">          
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>      
                <span class="icon-bar"></span>  
                <span class="icon-bar"></span>  
                <span class="icon-bar"></span>          
              </button> 
              <a href="#"><img src="./../1students/students_files/logo.png" class="img-responsive img-logo" width="210px" alt=""></a>
             </div>

            <!-- <div class="collapse navbar-collapse">   

               <ul class="navbar-right">
                <li><a class="btn btn-danger btn-sm" href="../../login/deconnection.php" style="font-size:12px;">déconnecter <i class="fas fa-sign-out-alt"></i></a></li>
              </ul>
            </div> -->
        </div>
    </div>
<div class="clear"></div>
<div class="container-fluid">

<link media="all" type="text/css" rel="stylesheet" href="./../1students/students_files/datatables.min.css">
<script src="./../1students/students_files/datatables.min.js"></script>
  <script src="./../1students/students_files/en.js"></script>

<div class="panel panel-default panel-main">
  <div class="panel-body">
<?php
     if(isset($_GET['inculpation_detail'])){
      $inculpation_detail=$_GET['inculpation_detail'];
?>
  <ol class="breadcrumb">
    <li><a href="Gradebook.php">Acceuil</a></li>
    <li class="active"><?php echo $inculpation_detail ?></li>
  </ol>



  <?php

if(isset($_REQUEST['nom_prenom'], $_REQUEST['adresse'], $_REQUEST['date_reception'], $_REQUEST['inculpation'], $_REQUEST['decision']))
{
  $nom_prenom = stripslashes($_REQUEST['nom_prenom']);
  $nom_prenom = mysqli_real_escape_string($conn, $nom_prenom);

  $adresse = stripslashes($_REQUEST['adresse']);
  $adresse = mysqli_real_escape_string($conn, $adresse);

  $date_reception = stripslashes($_REQUEST['date_reception']);
  $date_reception = mysqli_real_escape_string($conn, $date_reception);

  $inculpation = stripslashes($_REQUEST['inculpation']);
  $inculpation = mysqli_real_escape_string($conn, $inculpation);

  $decision = stripslashes($_REQUEST['decision']);
  $decision = mysqli_real_escape_string($conn, $decision);

    //inculpation id
    $inculp = $bdd->prepare("SELECT id_inculpation FROM type_inculpation WHERE inculpation='$inculpation'");

    $inculp->execute();
    $resultat = $inculp->fetch();
    $id_inculpation = $resultat['id_inculpation'];

  //requéte SQL + mot de passe crypté
  $query = "INSERT INTO `dossierinculpe` (`nom`, `adresse`,`date_reception` , `id_inculpation`, `decision`)
          VALUES ('$nom_prenom', '$adresse', '$date_reception', '$id_inculpation', '$decision')";

  // Exécuter la requête sur la base de données
  $res = mysqli_query($conn, $query);
  if($res){
    $url="student_graduate.php?inculpation_detail=".$inculpation_detail;
    header("Location: $url");
  }
}else{
?>

<!-- <a href="../1students/Nouvel_etudiant.php" class="btn btn-warning btn-lg"><i class="fa fa-user-plus"></i> new student</a> -->




<a data-toggle="modal" data-target="#new_bulletin" href="./bulletin#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> nouveau inculpation </a>

<div class="modal fade bs-example-modal-lg" id="new_bulletin">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">nouveau inculpation</h4>
      </div>
      <div class="modal-body">

      <div class="col-md-12">

<form method="POST" action="student_graduate.php?inculpation_detail=<?php echo $_GET['inculpation_detail']?>" accept-charset="UTF-8" class="col-md-12" id="myForm">
<input name="_token" type="hidden" value="9g4ipjNErSON1N3c7z0WBpHJxpBzKc3MUc6CNhQ0">

<div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Nom et Prénom : </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                    <input placeholder="" class="form-control input-lg" required="required" name="nom_prenom" type="text" value=""> 
                  </div>

                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label"> Adresse : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                  <input placeholder="" class="form-control input-lg" required="required" name="adresse" type="text" value=""> 
                </div>

                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Date_reception : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                  <input placeholder="date de reception" class="form-control input-lg" required="required" name="date_reception" type="date" value=""> 
                </div>

                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                </div>
              </div>

            <div class="col-md-12">
              <div class="form-group">
                    <label class="control-label"> Inculpation : </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-blackboard"></i></span>
                      <select required name="inculpation" id="class" class="form-control  input-lg">
                      <option selected  value="<?php echo $inculpation_detail ?>"><?php echo $inculpation_detail ?></option>
                          <option value="<?php echo $inculpation_detail ?>"><?php echo $inculpation_detail ?></option>
                      </select>
                    </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label"> Decision : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                  <input placeholder="" class="form-control input-lg" required="required" name="decision" type="text" value=""> 
                </div>

                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                </div>
              </div>

              <div class="col-md-12 margin-top-10">
                <input class="btn btn-info btn-block submit" type="submit" value="ajouter"> 
              </div>
</div>

<div class="clear"></div><br>

        <div class="col-md-12">
          <div id="resultajax" class="center"></div>
        </div>

</form>
      </div>
        <div class="clear"></div><br>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php } ?>


<div class="clear"></div><hr>
<div class="clear"></div>
<div class="table-responsive">
       <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
         
          <div class="row">
            <div class="col-sm-12">
              <table id="example" class="table table table-striped table-bordered display dataTable no-footer" style="width:100%" role="grid" aria-describedby="example_info">
          <thead>

          <tr role="row">
            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending" style="width: 84px;">Profile</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Full name: activate to sort column ascending" style="width: 181px;">Nom et Prenom</th>
            <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="class: activate to sort column ascending" style="width: 153px;">Class</th> -->
            <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="profile: activate to sort column ascending" style="width: 90px;">Profile</th> -->
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="guardian: activate to sort column ascending" style="width: 117px;">Adresse</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="contact: activate to sort column ascending" style="width: 102px;">Date de reception</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Gradebook: activate to sort column ascending" style="width: 134px;">Decision</th>
            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="#: activate to sort column ascending" style="width: 80px;">#</th>
          </tr>
        </thead>
        <tbody>
         <?php

         $get_id_inculpation = $bdd->prepare("SELECT id_inculpation FROM type_inculpation WHERE inculpation='$inculpation_detail'");
         $get_id_inculpation->execute();
         $resultat = $get_id_inculpation->fetch();
         $id_inculpate = $resultat['id_inculpation'];

          $get_inculpe = $bdd->prepare("SELECT * FROM `dossierinculpe` WHERE id_inculpation='$id_inculpate'");
          $get_inculpe->execute();

          /* inserer image dans variable get_user_image
          $get_user_image = $base->prepare('SELECT images FROM eleve WHERE id_eleve = ?');
          
          *///Boucle Parcourir Table eleve:
          while($inculpe_data = $get_inculpe->fetch()){

            /*$get_user_image->execute(array(
              $student_data['id_eleve']
            ));
            $user_image = $get_user_image->fetch()[0];

            //Testons s'il a une image ou pas !!...
            if($user_image == "" and $student_data['genre']=="Fille") {
              $user_image = "../1students/upload/photo_de_profile/student_girl.png";
            }
            elseif($user_image == "" and $student_data['genre']=="Garçon") {
              $user_image = "../1students/upload/photo_de_profile/boy_student.jpg";
            }*/
            $user_image = "Gradebook_files/wentorth_miller.jpeg";
          ?>
          <tr class="tr-body odd" role="row">

            <td class="sorting_1">
            <a title="profile" href="#">
            <img src="<?php echo $user_image ?>" class="img-circle" width="60px" height="60px" alt=""></a>
            </td>
            <td><?php echo $inculpe_data['nom'] ?></td>
            <!-- <td> <?php //echo $result['class']?> </td> -->          
            <!-- <td><a href="../1studentsstudent_profile.php?id_eleve_profile=<?php //echo $result['id_eleve'] ?>"><i class="fas fa-user-graduate" title="profile"></i></a></td> -->
            <td><?php echo $inculpe_data['adresse'] ?></td>
            <td><?php echo $inculpe_data['date_reception'] ?></td>
            <td><?php echo $inculpe_data['decision'] ?></td>
            <td>
              <a title="editer" class="btn btn-success" href="dossierinculpe_edit.php?id_update=<?php echo $inculpe_data['id_inculpe'] ?>"><i class="fa fa-edit"></i></a>
              <a title="effacer" class="btn btn-danger" onclick="return confirm(&#39;delete&#39;)" href="delete_inculpe.php?id_del_inculpe=<?php echo $inculpe_data['id_inculpe']?>"><i class="fa fa-trash"></i></a>
            </td>

          </tr>
          <?php } 
            }
          ?>
        </tbody>

      </table>
    </div>
  </div>
 
</div>
    </div>
    <!-- /.table-responsive -->

  </div>
</div>
</div>
    <script src="./Gradebook_files/bootstrap.min.js"></script>
     <script src="./Gradebook_files/validator.js"></script>
     <script src="../library/fontawesome/js/all.js"></script>
     
</body></html>