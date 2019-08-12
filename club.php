<?php
session_start();

require __DIR__ . '/vendor/autoload.php';
include('config.inc.php');
/*
* Listar todos los registros de la direccion API
* especificamente a lo concerniente a los que son todos los registros
*/

use GuzzleHttp\Client;

$client = new Client();
$token = $_SESSION['id_token'];

$headers = [
    'Authorization' => 'Bearer '. $token,
    'Accept' => 'application/json'
];

$res = $client->request(
    'GET',
    DIRECCION_BASE.'/api/clubs',
    [ 'headers' => $headers ]
);

/*
* Si todo va bien obtenemos los registros y mostramos en pantalla
* En este caso especifico sabe 200 en el codigo de estado
*/
if ($res->getStatusCode() == '200'){
  $data = json_decode($res->getBody(), true);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Starter Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Api REST</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entities</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="country.php">Country</a>
          <a class="dropdown-item" href="player.php">Player</a>
          <a class="dropdown-item" href="club.php">Club</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="logout.php" method="post">      
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav>

<main role="main" class="container">

  <div class="starter-template">
    <h1>Clubs</h1>    
    <div class="text-right">
        <button type="button" class="btn btn-primary" type="submit" onclick="location.href='insertClub.php'">Insert Club</button>
        <p></p>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">City</th>
            <th scope="col">Telephone</th>
            <th scope="col">Partners</th>
            <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($data as $key => $value) {
            # code...        
        ?>
            <tr>
            <th scope="row"><?php echo $key+1; ?></th>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['city']; ?></td>
            <td><?php echo $value['telephone']; ?></td>
            <td><?php echo $value['numSocios']; ?></td>
            <td>[ <a href="viewClub.php?id=<?php echo $value['id']; ?>">Ver</a> ] [ <a href="updateClub.php?id=<?php echo $value['id']; ?>">Editar</a> ] [ <a href="deleteClub.php?id=<?php echo $value['id']; ?>">Eliminar</a> ]</td>
            </tr>
        <?php 
        }
        ?>
        </tbody>
    </table>
  </div>

</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script><script src="js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>
</html>
<?php
}
?>