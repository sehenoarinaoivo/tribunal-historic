<?php 
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: ../login/login.php");
    exit(); 
  }
?>
<?php 
$bdd = new PDO("mysql:host=localhost;dbname=sekoly","root","");
if(  isset($_GET['id']) && isset($_POST['name']) && isset($_POST['nombre']) ) {
  $id=$_GET['id'];
$name=$_POST['name'];
$nombre=$_POST['nombre'];
echo("$id");
  $sql=("UPDATE classe SET nom_class='$name',propos_class='$nombre' WHERE id_class='$id' ");
  $action = $bdd->prepare($sql);
  $action->execute();
  header('location:classes.php');
}?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">


    <link rel="stylesheet" href="../../bootstrap-4.5.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../fontawesome/css/all.css">
      
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
        </div>
      </div>
    </nav>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Edit Profile
              </div>
              <div class="card-body">
                <?php 
                
                $id=$_GET['id'];
                $requet=$bdd->query("SELECT * FROM classe where id_class='$id'" );
                $resultat=$requet->fetch();

                ?>
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="classe">Classe</label>
                      <input type="text" class="form-control" name="name"  placeholder="" value="<?php echo $resultat['nom_class']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="nombre d'edutiant">Nombre d'edutiant</label>
                      <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $resultat['propos_class']; ?>">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Envoyer" class="btn btn-primary waves">
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../../bootstrap-4.5.3/dist/js/bootstrap.js" charset="utf-8"></script>
    
      <script src="../../jquery-3.6.0.min.js" charset="utf-8"></script>
  </body>
</html>
