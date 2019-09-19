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
      <td> autor_id </td>
      <td> editorial_id </td>
      <td> Preu </td>
    </tr>
  </th>
  <tbody>
  <?php
  $sql = "SELECT * FROM llibres";

  $dosql = $con->query($sql);
  while($result=$dosql->FETCH_ASSOC()){
    echo "<tr><td>".utf8_encode($result["titol"])."</td>
          <td>".utf8_encode($result["autor_id"])."</td>
          <td>".utf8_encode($result["editorial_id"])."</td>
          <td>".$result["preu"]."</td></tr>";
  }
  ?>
  </tbody>
  </table>
  </body>
</html>