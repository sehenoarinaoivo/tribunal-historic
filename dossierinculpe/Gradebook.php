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

    include("../database/config_PDO.php"); //connecting Data;
    require("../database/config_procedural.php");  //connecting Data

?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="icon" href="./images/favicon.png">
    <title> Historic Inculpation </title>
    <link media="all" type="text/css" rel="stylesheet" href="./Gradebook_files/bootstrap.css">

    <link media="all" type="text/css" rel="stylesheet" href="./Gradebook_files/bootstrap-theme.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="./Gradebook_files/font-awesome.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">

    <script src="./Gradebook_files/jquery-1.11.3.min.js"></script>
    <link media="all" type="text/css" rel="stylesheet" href="./Gradebook_files/style.css">

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
              <a href="."><img src="./Gradebook_files/logo.png" class="img-responsive img-logo" width="210px" alt=""></a>
             </div>
            <div class="collapse navbar-collapse">   
              <ul class="navbar-right">                 
                  <li>
                    <a data-toggle="modal" data-target="#new_class" href="/4classes/classes#" class="btn btn-warning btn-lg"><i class="fa fa-chalkboard-teacher"></i></i> type d'inculpation</a>
                    </li>
                </ul>
               <!-- <ul class="navbar-right">                 
                <li><a class="btn btn-danger btn-sm" href="../../login/deconnection.php" style="font-size:12px;"> déconnecter <i class="fas fa-sign-out-alt"></i></a></li>
              </ul>-->
            </div> 
        </div>
    </div>


<div class="clear"></div>
<div class="container-fluid">
<?php

        if(isset($_REQUEST['inculpation']))
        {
          $inculpation = stripslashes($_REQUEST['inculpation']);
          $inculpation = mysqli_real_escape_string($conn, $inculpation); 


          //requéte SQL + mot de passe crypté
          $query = "INSERT INTO `type_inculpation` (`inculpation`) VALUES ('$inculpation')";

          // Exécuter la requête sur la base de données
          $res = mysqli_query($conn, $query);
          if($res){
            header("Location: Gradebook.php");
          }
      }else{

?>

<div class="panel panel-default panel-main">
  <div class="panel-body">
  <!--  
  <ol class="breadcrumb">
       <li><a href="../homeAdmin.php">Home</a></li> 
    <li class="active">Acceuil</li>
  </ol>-->

<div class="modal fade" id="new_class" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">type d'inculpation</h4>
      </div>
      <div class="modal-body">
        

<form method="POST" action="" accept-charset="UTF-8" class="col-md-12" id="myForm" data-toggle="validator" novalidate="true"><input name="_token" type="hidden" value="6uinzD5MrRoToKoJCgQ1i6MuOmaXp2LmCJqhQGQm">

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  
      
              <div class="form-group has-error has-danger">
                <label class="control-label">Type d'inculpation : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                <input placeholder="" class="form-control input-lg" required="required" name="inculpation" type="text" value=""> 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"><ul class="list-unstyled"><li>Veuillez remplir ce champ.</li></ul></div>
              </div>

              <!-- <div class="form-group">
                <label class="control-label">note : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                <textarea rows="5" class="form-control" name="propos_class" cols="50"></textarea> 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div> -->
      </div>

      <div class="clear"></div><br>
      <div class="col-md-12">
        <input class="btn btn-info btn-block input-lg disabled" type="submit" value="ajouter"> 
      </div>
</form>
     
  <div class="clear"></div><br>
  <div class="clear"></div><hr>

<script type="text/javascript">   

          function refresh() {
            // to current URL
            window.location='./Gradebook.php';
          }

</script>

      </div>
      <div class="modal-footer">
        <button type="button" onclick="refresh();" class="btn btn-default" data-dismiss="modal">fermer</button>
      </div>
    </div><!-- /.modal-content -->
    <?php } ?>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal Student first-->

    <div class="table-responsive">
      <div class="modal fade" id="class-64">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">     
 
 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student second -->

<div class="modal fade" id="class-65">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">     
 
 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Third -->

<div class="modal fade" id="class-66">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student fourth -->

<div class="modal fade" id="class-79">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Fiveth -->

<div class="modal fade" id="class-82">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Sixth -->

<div class="modal fade" id="class-83">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Seventh -->

<div class="modal fade" id="class-87">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Eighth -->

<div class="modal fade" id="class-88">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">     
 

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Nineth -->

<div class="modal fade" id="class-89">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Tenth -->

<div class="modal fade" id="class-90">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--Modal Student Eleventh -->

<div class="modal fade" id="class-91">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">students</h4>
      </div>
      <div class="modal-body">

 <div class="list-group">
  </div>

</div>
<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">close</button></div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- #############################################Ending Modal Student#########################################-->

<table class="table table table-striped table-bordered">
  <thead>
    <tr class="tr">
      <th>Type d'Inculpation</th>
      <th> Détail d'Inculpation </th>

    </tr>
  </thead>
<tbody>
        <?php


            $ins=$bdd->prepare("SELECT DISTINCT inculpation FROM `type_inculpation`");
            $ins->execute();

            while($result=$ins->fetch())
            {

            ?>
          <tr class="tr-body">
            <td><?php echo  $result["inculpation"] ?></td>
            <td>
              <!-- <button data-toggle="modal" data-target="#class-64" class="btn btn-info">
                <i class="fa fa-file-text"></i> students
              </button> -->
              <a href="student_graduate.php?inculpation_detail=<?php echo $result["inculpation"] ?>"><i class="fa fa-user-graduate" style="font-size:20px"></i></a>
            </td>
          </tr><?php
            }
        ?>
<!-- /.modal -->

        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div></div></div>

     <script src="./Gradebook_files/bootstrap.min.js"></script>
     <script src="./Gradebook_files/validator.js"></script>
     <script src="../library/fontawesome/js/all.js"></script>

</body>
</html>