<?php /*Ens connectem a la base de dades es podria fer amb un include i tenir la conexió en un fitxer apart */
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
    <title>Biblioteca de Llibres</title>
  </head>
    <!-- Estils per arreglar-ho una mica --> 
  <style> 
    tr:nth-child(odd) {background: #C0C0C0}
    th {background: #fff}

    button{border-radius: 8px;}
  </style>

  <!-- Javascript que ens posarà i treurà els estils per fer l'efecte de pestanyes --> 
  <script>
    function tabllista(list) {
      var i;
      var x = document.getElementsByClassName("llistat");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      document.getElementById(list).style.display = "block";
    }
  </script>
  <body>
<!-- Butons que al fer click canvien la taula a mostrar. -->
    <div class="w3-bar w3-black">
    <button  onclick="tabllista('Llistat')">Llistat básic</button>
    <button  onclick="tabllista('Editorials')">Llistat d'editorials per autor</button>
    <button  onclick="tabllista('barats')">Llistat de llibres menors de 15€ (sense IVA)</button>
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
        /*
        Fem un select dels llibres amb left joins per mostrar el nom corresponent segons la id de la taula
        */
        $sql = "SELECT  autors.nom, editorials.nom AS nomeditorial, llibres.titol, llibres.preu 
                FROM llibres
                LEFT JOIN autors
                ON llibres.autor_id = autors.id
                LEFT JOIN editorials
                ON llibres.editorial_id = editorials.id
        ";
        /*
          Printem els resultats de la query a mesura que els va llegint
        */
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
        /*
          Semblant al previ, un select amb left joins, de la taula que fa d'enllaç many-to-many 
        */
          $sql = "SELECT  editorials.nom AS editorial, autors.nom as autor
                  FROM editorialsautors
                  LEFT JOIN editorials
                  ON editorialsautors.editorial_id = editorials.id
                  LEFT JOIN autors
                  ON editorialsautors.autor_id = autors.id
          ";

          $dosql = $con->query($sql);
          while($result=$dosql->FETCH_ASSOC()){
            echo "<tr><td>".utf8_encode($result["autor"])."</td>
                  <td>".utf8_encode($result["editorial"])."</td>";
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

      /*
            Fem un select dels llibres amb la condició que el preu sigui menor a 15€, un cop rebem el preu li apliquem l'IVA i es printa.
      */
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

<!-- Tanquem la conexió a la BDD -->
<?php
  $con->close();
?>