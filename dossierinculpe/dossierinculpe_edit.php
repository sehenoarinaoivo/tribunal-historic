<?php 
/*session_start();
if(!isset($_SESSION["admin"])){
    header("Location: ../../login/login.php");
    exit(); 
  }*/
?>
<?php 
    include("../database/config_PDO.php");
    include("../database/config_procedural.php");

if(isset($_GET['id_update']) && isset($_POST['nom_prenom']) && isset($_POST['adresse']) && isset($_POST['date_reception']) && isset($_POST['inculpation']) && isset($_POST['decision'])) {
  $id_upd=$_GET['id_update'];
  $nom_prenom = $_POST['nom_prenom'];
  $adresse = $_POST['adresse'];
  $date_reception = $_POST['date_reception'];
  $inculpation = $_POST['inculpation'];
  $decision = $_POST['decision'];

  $get_id_inculpe = $bdd->query("SELECT id_inculpation FROM type_inculpation WHERE inculpation='$inculpation'");
  $result = $get_id_inculpe->fetch();
  $id_inculpate = $result['id_inculpation'];

  $sql=("UPDATE `dossierinculpe` SET `nom`='$nom_prenom',`adresse`='$adresse',`date_reception`='$date_reception',`id_inculpation`='$id_inculpate', `decision`='$decision' WHERE `id_inculpe`='$id_upd' ");
  $action = $bdd->prepare($sql);
  $action->execute();
  
  header('location:Gradebook.php');
} 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <?php
 if(isset($_GET['id_update'])){
   $id_upd = $_GET['id_update'];

   $get_dossierinculpe = $bdd->query("SELECT * FROM dossierinculpe WHERE id_inculpe='$id_upd'");
   $result = $get_dossierinculpe->fetch();
   $id_inculpation = $result['id_inculpation'];

   $get_inculpation = $bdd->query("SELECT inculpation FROM type_inculpation where id_inculpation='$id_inculpation'");
   $resulat = $get_inculpation->fetch();

 ?>
  <title><?php echo $result['nom'] ?></title>
  <link media="all" type="text/css" rel="stylesheet" href="Gradebook_files/bootstrap.css">

  <link media="all" type="text/css" rel="stylesheet" href="Gradebook_files/bootstrap-theme.css">

  <link media="all" type="text/css" rel="stylesheet" href="Gradebook_files/font-awesome.css">
  <link rel="stylesheet" href="../library/fontawesome/css/all.css">
  <script src="subjects_files/jquery-1.js"></script>
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
        <a href="#"><img src="subjects_files/logo.png" class="img-responsive img-logo" alt="" width="210px"></a>
      </div>

      <!-- <div class="collapse navbar-collapse">

        <ul class="navbar-right">

          <li><a class="btn btn-danger btn-sm" href="../../login/deconnection.php" style="font-size:12px;">déconnecter <i
                class="glyphicon glyphicon-log-out"></i></a></li>
        </ul> 
      </div> -->
    </div>
  </div>
  <div class="clear"></div>
  <div class="container-fluid">
  
    <div class="panel panel-default panel-main">
      <div class="panel-body">
        <ol class="breadcrumb">
        <li><a href="Gradebook.php">Acceuil</a></li>
          <li><a href="student_graduate.php?inculpation_detail=<?php echo $resulat["inculpation"] ?>"><?php echo $resulat['inculpation'] ?></a></li>
          <li class="active"><?php echo $result['nom'] ?></li>
        </ol>
   
        <div class="clear"></div><hr>

      <form method="POST" action="" accept-charset="UTF-8" class="col-md-12" id="myForm2" data-toggle="validator"
          novalidate="true"><input name="_token" type="hidden" value="IHbYdb1vh3sjgHcwx6gFbNPARNcCg6yODWlCREcm">

          <div class="col-md-12">
            <div id="resultajax2" class="center"></div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">nom et prénom :</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                <input placeholder="" class="form-control" required="required" name="nom_prenom" type="text" value="<?php echo $result['nom'] ?>">
              </div>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label"> adresse :</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                <input placeholder="" class="form-control" required="required" name="adresse" type="text" value="<?php echo $result['adresse'] ?>">
              </div>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label"> date de reception :</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                <input placeholder="" class="form-control" required="required" name="date_reception" type="date" value="<?php echo $result['date_reception'] ?>">
              </div>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label">inculpation : </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
<?php
      $get_id_inculpation = $bdd->query("SELECT id_inculpation FROM dossierinculpe WHERE id_inculpe='$id_upd'");
      $resultat = $get_id_inculpation->fetch();
      $id_inculpation = $resultat['id_inculpation'];
      
      $get_inculpate = $bdd->query("SELECT inculpation FROM type_inculpation WHERE id_inculpation='$id_inculpation'");
      $resultat = $get_inculpate->fetch();
?>
                <select name="inculpation" class="form-control input-lg">

                  <option selected="selected"><?php echo $resultat['inculpation']; ?></option>
                  <?php 
                    $requet=$bdd->query("SELECT * FROM type_inculpation ");
                    while($resultat=$requet->fetch() ) { ?>
                  <option value="<?php  echo $resultat['inculpation']; ?>">
                    <?php  echo $resultat['inculpation']; ?>
                  </option>
                  <?php }?>
                </select>

              </div>

              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label"> decision :</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                <input placeholder="" class="form-control" required="required" name="decision" type="text" value="<?php echo $result['decision'] ?>">
              </div>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

          </div>
          

          <div class="clear"></div><br>
          <div class="col-md-12">
            <input class="btn btn-success btn-block input-lg" type="submit" value="mettre à jour">
          </div>

        </form>
<?php } ?>
        <div class="clear"></div><br><br>

        <script src="Gradebook_files/bootstrap.js"></script>
        <script src="Gradebook_files/validator.js"></script>
        <script src="../library/fontawesome/js/all.js"></script>
</body>

</html>