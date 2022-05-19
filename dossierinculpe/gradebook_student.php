<?php 
/*session_start();
if(!isset($_SESSION["admin"])){
    header("Location: ../login/login.php");
    exit(); 
  }
  */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
  include('../database/config_PDO.php');         //CONNECTING data
  include("../database/config_procedural.php"); //CONNECTING DATA..
?>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" href="./images/favicon.png">
    <title> Gradebook </title>
    <link media="all" type="text/css" rel="stylesheet" href="./../7emploi/timetable_profile_files/bootstrap.css">
    <link media="all" type="text/css" rel="stylesheet" href="./../7emploi/timetable_profile_files/bootstrap-theme.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="./../7emploi/timetable_profile_files/font-awesome.css">
    <script src="./../7emploi/timetable_profile_files/jquery-1.11.3.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="./../7emploi/timetable_profile_files/style.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">

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
              <a href="."><img src="./../7emploi/timetable_profile_files/logo.png" class="img-responsive img-logo" width="210px" alt=""></a>
             </div>

            <div class="collapse navbar-collapse">   

               <ul class="navbar-right">                 
                <li><a class="btn btn-danger btn-sm" href="../../login/deconnection.php" style="font-size:12px;"> déconnecter <i class="fas fa-sign-out-alt"></i></a></li>
              </ul>

            </div>
        </div>
    </div>

<div class="container-fluid">

<div class="panel panel-default panel-main">
  <div class="panel-body">
    <?php
        if(isset($_GET['student_name'])){
            $name_student_graduate=$_GET['student_name'];
            $get_student=$base->prepare("SELECT * FROM eleve WHERE nom_prenom='$name_student_graduate'");
            $get_student->execute();
            $student=$get_student->fetch();

    $get_mark_info=$base->prepare("SELECT * FROM marks WHERE student_name='$name_student_graduate'");
    $get_mark_info->execute();
?>
  <ol class="breadcrumb">
    <li><a href="../homeAdmin.php">Home</a></li>
    <li class="active"><a href="Gradebook.php">Classe</a> </li>
    <li class="active"><a href="student_graduate.php?nom_class_student=<?php echo $student["class"] ?>"><?php echo $student["class"] ?></a> </li>
    <li class="active"> <b><?php echo $name_student_graduate ?></b> </li>
  </ol>


  <?php

if(isset($_REQUEST['matiere_marks'], $_REQUEST['class_marks'], $_REQUEST['student_name'], $_REQUEST['mark_student']))
{
  $matiere_marks = stripslashes($_REQUEST['matiere_marks']);
  $matiere_marks = mysqli_real_escape_string($conn, $matiere_marks); 

  $class_marks = stripslashes($_REQUEST['class_marks']);
  $class_marks = mysqli_real_escape_string($conn, $class_marks);
  
  $student_name = stripslashes($_REQUEST['student_name']);
  $student_name = mysqli_real_escape_string($conn, $student_name); 

  $mark_student = stripslashes(doubleVal($_REQUEST['mark_student']));
  $mark_student = mysqli_real_escape_string($conn, $mark_student);

  if($mark_student>=0 && $mark_student<=5){
    $propos_mark='Too Weak';
  }
  elseif($mark_student>5 && $mark_student<=10){
    $propos_mark='Effort Needed';
  }
  elseif($mark_student>10 && $mark_student<=12){
    $propos_mark="Assez-Bien";
  }
  elseif($mark_student>12 && $mark_student<=14){
    $propos_mark="Bien";
  }
  elseif($mark_student>14 && $mark_student<20){
    $propos_mark="Tres-Bien";
  }
  elseif($mark_student>20 || $mark_student>0){
    $propos_mark="Verification Recomanded";
  }
  //requéte SQL + mot de passe crypté
  $query = "INSERT into `marks` (`matiere_marks`, `class_marks`,`student_name` , `mark_student`, `propos_mark`) 
  VALUES ('$matiere_marks', '$class_marks', '$student_name', '$mark_student', '$propos_mark')";

  // Exécuter la requête sur la base de données
  $res = mysqli_query($conn, $query);
  if($res){
    $url="gradebook_student.php?student_name=".$name_student_graduate;
    header("Location: $url");
  }
}else{
  ?>
<!-- <a href="nouvelTimetable.php" class="btn btn-warning btn-lg"><i class="fa fa-calendar"></i> new marks</a>
<hr> -->


<a data-toggle="modal" data-target="#new_bulletin" href="./bulletin#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> new marks</a>

<div class="modal fade bs-example-modal-lg" id="new_bulletin">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">New Note <b><?php echo $_GET['student_name'] ?></b></h4>
      </div>
      <div class="modal-body">

      <div class="col-md-12">

<form method="POST" action="gradebook_student.php?student_name=<?php echo $_GET['student_name'] ?>" accept-charset="UTF-8" class="col-md-12" id="myForm">
<input name="_token" type="hidden" value="9g4ipjNErSON1N3c7z0WBpHJxpBzKc3MUc6CNhQ0">

<div class="row">

            <div class="col-md-12">
              <div class="form-group">
                    <label class="control-label">class  : </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-blackboard"></i></span>
                      <select required name="class_marks" id="class" class="form-control  input-lg">
                      <option selected value="<?php echo $student['class']?>"><?php echo $student['class']?></option>
                      
                      <option value="<?php echo $student['class']?>"><?php echo $student['class']?></option>
                      
                    </select>
                    </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group student">
                    <label class="control-label">student : </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                    <select selected name="student_name" id="student" class="form-control input-lg">
                        <option selected value="<?php echo $student['nom_prenom'] ?>"><?php echo $student['nom_prenom'] ?></option>
                          <option value="<?php echo $name_student_graduate ?>"><?php echo $name_student_graduate ?></option>
                      </select>
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group subject">
                    <label class="control-label">subjects : </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-book"></i></span>
                    <select required name="matiere_marks" id="subject" class="form-control input-lg">
                        <option value="">select</option>
                        <?php 
             
                          $ins=$base->prepare("SELECT DISTINCT nom_matiere FROM `subject`");
                          $ins->execute();

                          while($result=$ins->fetch())
                          {
                        ?>  
                          <option value="<?php echo $result["nom_matiere"] ?>"><?php echo $result["nom_matiere"] ?></option>
                        <?php
                          }
                        ?>
                    </select>

                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">mark : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                  <input placeholder="note" class="form-control input-lg" required="required" name="mark_student" type="text" value=""> 
                </div>

                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
              </div>

              <div class="col-md-12 margin-top-10">
                <input class="btn btn-info btn-block submit" type="submit" value="add"> 
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
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php } ?>
<div class="clear"></div><hr>






<a href="student_graduate.php?nom_class_student=<?php echo $student["class"] ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> all student </a><br>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th> Subject </th>
            <th> Note </th>
            <th> Professeur </th>         
            <th>Mention</th>
            <th>#</th>
          </tr>
        </thead>
        <tbody>
        <?php  
            $div=1;
            $totalnote=0;
            //Boucle Parcourir Table class
            while($mark_data=$get_mark_info->fetch()){ 
                $div++;
                $totalnote=$totalnote+$mark_data['mark_student'];  
        ?>

          <tr class="tr-body">
            <td><?php echo $mark_data["matiere_marks"] ?></td>
            <td><?php echo $mark_data["mark_student"] ?></td>
            <td><?php echo $mark_data["matiere_marks"] ?></td>
          <?php            
              if($mark_data["propos_mark"]=="Verification Recomanded"){
          ?>
            <td><span class="badge red-bg"><?php echo $mark_data["propos_mark"] ?><span class="badge green-bg"></span></td>
          <?php
            }else{
          ?>
            <td><?php echo $mark_data["propos_mark"] ?></td>
            <?php } ?>
            <td>
              <a class="btn btn-success" href="gradebook_student_edit.php?id_update_mark=<?php echo $mark_data['id_marks'] ?>"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger" onclick="return confirm(&#39;delete&#39;)" href="delete_mark.php?id_del_mark=<?php echo $mark_data['id_marks']?>"><i class="fa fa-trash"></i></a>
            </td>

          </tr>
        <?php  
        } 
          if($div>1){
            $div=$div-1;
        }

            $moyenne=floatval($totalnote/$div);
        ?>
            <tr class="">
                <td>Total</td>
                <td><?php echo $totalnote ?></td>
            </tr>
            <tr>
                <td>Moyenne</td>
                <td><?php echo $moyenne?></td>
            </tr>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <?php }     ?>
  </div>
</div>

</div>
     <script src="./../7emploi/timetable_profile_files/bootstrap.min.js"></script>
     <script src="./../7emploi/timetable_profile_files/validator.js"></script>
     <script src="../fontawesome/js/all.js"></script>
            

</body></html>