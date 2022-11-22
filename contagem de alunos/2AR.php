<?php
Include_once("conexao.php") ;

$selecao = "SELECT * FROM aluno";
$result_selecao = mysqli_query($conn, $selecao);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Contagem de Alunos CEEP</title>
<link rel="stylesheet" type="text/css" href="style2ar.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<center>
<img src='WhatsApp_Image_2022-10-27_at_16.49.39-removebg-preview.png'>
</center>
<div id="quadrado">
<br>
<h2 id="contagem">Contagem de Alunos</h2>
<br>
<h2 id="AR">2°A REDES</h2>
<br>
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Alunos</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Data</th>
      <th scope="col">Horário de Chegada</th>
      <th scope="col">Horário de Saída</th>
    </tr>
  </thead>
  <tbody>
     <?php while($row_aluno = mysqli_fetch_assoc($result_selecao)) {?>
    <tr>
      <td><?php echo $row_aluno['nome_aluno' ]; ?></td>
      <td><?php echo $row_aluno['id_aluno' ]; ?></td>
      <td><?php echo $row_aluno['data_' ]; ?></td>
      <td><?php echo $row_aluno['hora_chegada' ]; ?></td>
      <td><?php echo $row_aluno['hora_saida' ]; ?></td>
    </tr>
     <?php }?>
  </tbody>
</table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="2ar.js"></script>
</body>
</html>