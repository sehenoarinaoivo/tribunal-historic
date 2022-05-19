<?php 
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: ../../login/login.php");
    exit(); 
  }
?>
<?php 
include("../config_PDO.php"); //CONNECTING data...

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php 
        if(isset($_GET['id_update_mark'])){
        $id_marks=$_GET['id_update_mark'];
        $get_mark_info=$base->prepare("SELECT * FROM marks where id_marks='$id_marks'");
        $get_mark_info->execute();
        $mark_data=$get_mark_info->fetch();

    ?>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <link rel="icon" href="./easyschool/images/favicon.png">
  <title> Update Mark </title>
  <link media="all" type="text/css" rel="stylesheet" href="../5subjects/subjects_files/bootstrap.css">
  <link media="all" type="text/css" rel="stylesheet" href="../5subjects/subjects_files/bootstrap-theme.css">

  <link media="all" type="text/css" rel="stylesheet" href="../5subjects/subjects_files/font-awesome.css">
  <link rel="stylesheet" href="../fontawesome/css/all.css">
  <script src="../5subjects/subjects_files/jquery-1.js"></script>
  <link media="all" type="text/css" rel="stylesheet" href="../5subjects/subjects_files/style.css">

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
        <a href="#"><img src="../5subjects/subjects_files/logo.png" class="img-responsive img-logo" alt="" width="210px"></a>
      </div>

      <div class="collapse navbar-collapse">
        <ul class="navbar-right">

        <li><a class="btn btn-danger btn-sm" href="../../login/deconnection.php" style="font-size:12px;">logout <i
                class="fas fa-sign-out-alt"></i></a>
        </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <div class="container-fluid">
    <div class="panel panel-default panel-main">
      <div class="panel-body">
        <ol class="breadcrumb">
          <li><a href="../homeAdmin.php">Home</a></li>
          <li class="active"><a href="student_graduate.php?nom_class_student=<?php echo $mark_data["class_marks"] ?>"><?php echo $mark_data["class_marks"] ?></a></li>
          <li><a href="./gradebook_student.php?student_name=<?php echo $mark_data['student_name'] ?>">Gradebook</a></li>
          <li class="active">update note <?php echo $mark_data['student_name']?></li>
        </ol>
        <a data-toggle="modal" data-target="#new_class" href="#" class="btn btn-warning btn-lg"><i
            class="fa fa-book"></i> new subject</a>
        <div class="modal fade" id="new_class">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
                <h4 class="modal-title">new subject</h4>
              </div>
              <div class="modal-body">

                <form method="POST" action="add.php" accept-charset="UTF-8" class="col-md-12" id="myForm"
                  data-toggle="validator" novalidate="true"><input name="_token" type="hidden"
                    value="IHbYdb1vh3sjgHcwx6gFbNPARNcCg6yODWlCREcm">

                  <div class="col-md-12">
                    <div id="resultajax" class="center"></div>
                  </div>

                  <div class="col-md-12">

                    <div class="form-group">
                      <label class="control-label">name : </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                        <input placeholder="" class="form-control input-lg" required="required" name="name" type="text">
                      </div>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">class_mark : </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
 
                      </div>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">matiere_marks : </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
 
                      </div>

                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                      <label class="control-label">Note : </label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                    </div>
                      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="clear"></div><br>
                  <div class="col-md-12">
                    <input class="btn btn-info btn-block input-lg disabled" type="submit" value="update note">
                  </div>

                </form>

                <div class="clear"></div><br>
              </div>
              <div class="modal-footer">
                <button type="button" onclick="refresh();" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



<!-- ato ny tegan izzyy -->
         <div class="clear"></div><hr>

        <form method="POST" action="edit_gradebook_student.php?id_update_note=<?php echo $mark_data['id_marks'] ?>" accept-charset="UTF-8" class="col-md-12" id="myForm2" data-toggle="validator"
          novalidate="true"><input name="_token" type="hidden" value="IHbYdb1vh3sjgHcwx6gFbNPARNcCg6yODWlCREcm">

          <div class="col-md-12">
            <div id="resultajax2" class="center"></div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">student_name :</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <input placeholder="" class="form-control input-lg" readonly="readonly" required="required" name="student_name" type="text" value="<?php echo $mark_data['student_name'] ?>">
              </div>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label">class_marks : </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-blackboard"></i></span>
                <input value="<?php echo $mark_data['class_marks'] ?>" placeholder="" class="form-control input-lg" readonly="readonly" required="required" name="class_marks" type="text" >
              </div>

              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              <label class="control-label">matiere_marks : </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select name="matiere_marks" class="form-control input-lg">
                          <option selected="selected"><?php echo $mark_data['matiere_marks']?></option>
                        <?php
                            $get_matiere_info=$base->prepare("SELECT * FROM subject");
                            $get_matiere_info->execute();

                            while($subject_data=$get_matiere_info->fetch()){ 
                        ?>
                          <option value=<?php echo $subject_data['nom_matiere'] ?>><?php  echo $subject_data['nom_matiere']; ?></option>
                          <?php }?>
                        </select>
              </div>

              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label">Note_Mark : </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                <input placeholder="" value="<?php echo $mark_data['mark_student'] ?>" class="form-control input-lg" required="required" name="mark_student" type="text">  
              </div>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>

          </div>

          <div class="clear"></div><br>
          <div class="col-md-12">
            <input class="btn btn-success btn-block input-lg" type="submit" value="update">
          </div>

        </form>
<?php }?>
        <div class="clear"></div><br><br>

        <script src="../5subjects/subjects_files/bootstrap.js"></script>
        <script src="../5subjects/subjects_files/validator.js"></script>
        <script src="../fontawesome/js/all.js"></script>
</body>

</html>