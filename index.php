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
  
  <body>
  <table>
  <th>
    <tr>
      <td> Títol </td>
      <td> Autor </td>
      <td> Editorial </td>
      <td> Preu </td>
    </tr>
  </th>
  <tbody>
  <?php
  $sql = "SELECT  autors.nom, editorials.nom, llibres.titol, llibres.preu 
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
          <td>".utf8_encode($result["nom"])."</td>
          <td>".$result["preu"]."</td></tr>";
  }
  ?>
  </tbody>
  </table>
  </body>
</html>