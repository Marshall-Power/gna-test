<?php //Ens connectem a la base de dades
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "biblioteca";

  $con = new mysqli($server,$username,$password,$database);
  if($con->connect_error){
    die ("Error al connectar-se".$con->connect_error);
  }

  
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BDD de Llibres</title>
  </head>
  <style>
    tr:nth-child(odd) {background: #C0C0C0}
    th {background: #fff}
  </style>

  <script>
    function openCity(cityName) {
      var i;
      var x = document.getElementsByClassName("llistat");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      document.getElementById(cityName).style.display = "block";
    }
  </script>



  <body>
  <div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openCity('Llistat')">Llistat básic</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Editorials')">Llistat editorials per autor</button>
  <button class="w3-bar-item w3-button" onclick="openCity('barats')">Llistat menors de 15€ (sense IVA)</button>
</div>
  <div id="Llistat" class="llistat">
    <table>
      <tr>
          <th> Títol </th>
          <th> Autor </th>
          <th> Editorial </th>
          <th> Preu </th>
      </tr>
      <tbody>
      <?php
      $sql = "SELECT  autors.nom, editorials.nom AS nomeditorial, llibres.titol, llibres.preu 
              FROM llibres
              LEFT JOIN autors
              ON llibres.autor_id = autors.id
              LEFT JOIN editorials
              ON llibres.editorial_id = editorials.id
      ";

      $dosql = $con->query($sql);
      while($result=$dosql->FETCH_ASSOC()){
        echo "<tr><td>".utf8_encode($result["titol"])."</td>
              <td>".utf8_encode($result["nom"])."</td>
              <td>".utf8_encode($result["nomeditorial"])."</td>
              <td>".$result["preu"]."</td></tr>";
        }
      ?>
      </tbody>
    </table>
  </div>

<div id="Editorials" class="llistat" style="display:none">
  <table>
    <tr>
        <th> Editorial </th>
        <th> Autor</th>
    </tr>
    <tbody>
    <?php
      $sql = "SELECT  editorials.nom AS editorial, autors.nom as autor
              FROM editorialsautors
              LEFT JOIN editorials
              ON editorialsautors.editorial_id = editorials.id
              LEFT JOIN autors
              ON editorialsautors.autor_id = autors.id
      ";

      $dosql = $con->query($sql);
      while($result=$dosql->FETCH_ASSOC()){
        echo "<tr><td>".utf8_encode($result["editorial"])."</td>
              <td>".utf8_encode($result["autor"])."</td>";
        }
      ?>
    </tbody>
  </table>
  </div>

<div id="barats" class="llistat" style="display:none">
  <table>
    <tr>
      <th> Títol </th>
      <th> Autor </th>
      <th> Editorial </th>
      <th> Preu </th>
    </tr>
      <tbody>
      <?php
      $sql = "SELECT  autors.nom, editorials.nom AS nomeditorial, llibres.titol, llibres.preu 
              FROM llibres
              LEFT JOIN autors
              ON llibres.autor_id = autors.id
              LEFT JOIN editorials
              ON llibres.editorial_id = editorials.id
              WHERE preu < 15
      ";

      $dosql = $con->query($sql);
      while($result=$dosql->FETCH_ASSOC()){
        $total = $result["preu"]+($result["preu"]*(21/100));
        echo "<tr><td>".utf8_encode($result["titol"])."</td>
              <td>".utf8_encode($result["nom"])."</td>
              <td>".utf8_encode($result["nomeditorial"])."</td>
              <td>".round($total,2)."</td></tr>";
        }
      ?>
      </tbody>
    </table>
  </div>
</div>
  
  
  </body>
</html>