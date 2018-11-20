<?php include("cabecalho.php");

include "conn.php";

$palestrafilter = "";
if(isset($_GET['palestra'])){
  $palestrafilter = $_GET['palestra'];
}

try{
    $Conexao    = Conexao::getConnection();
    $query      = $Conexao->query("SELECT id, nome, data, palestrante FROM palestra where (del = b'0' and nome like \"%$palestrafilter%\") or (del = b'0' and palestrante like \"%$palestrafilter%\") or (del = b'0' and data like \"%$palestrafilter%\") or (del = b'0' and id like \"%$palestrafilter%\"); ");
    $palestras   = $query->fetchAll();
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}
finally{

}
?>
    <main role="main">

        <h1 class="text-center">Palestras</h1>
        <p class="lead text-center">Cadastre uma nova palestra.</p>
        <div class="mb-4 text-center">
          <a class="btn btn-lg btn-primary" href="paleform.php?tipo=incluir" role="button" name="tipo" value="incluir">Cadastrar Palestra</a>
        </div>

    </main>
    <div class="table-responsive">
    <table class="table table-hover table-active table-bordered text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Palestra</th>
      <th scope="col">Data</th>
      <th scope="col">Palestrante</th>
      <th scope="col">Editar</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php

  if(count($palestras) > 0){
      foreach($palestras as $palestra) {
        $date = date_create($palestra['data']);
   ?>
      <tr>
           <td><?php echo $palestra['id']; ?></td>
           <td><a href="<?php echo "paledetail.php?id=".$palestra['id']."&palestra=".$palestra['nome']. "&data=".date_format($date, 'd/m/y')."&palestrante=".$palestra['palestrante'] ?>"><?php echo $palestra['nome']; ?></a></td>
           <td><?php echo date_format($date, 'd/m/Y'); ?></td>
           <td><?php echo $palestra['palestrante']; ?></td>
           <td><a class="btn btn-info btn-sm" style="width: 100%" href="<?php echo "paleform.php?tipo=editar&id=".$palestra['id']."&palestra=".$palestra['nome']. "&data=".date_format($date, 'Y-m-d')."&palestrante=".$palestra['palestrante'] ?>">Editar</a></td>
           <td><button class="btn btn-danger btn-sm" style="width: 100%" onClick="abrirModal(<?php echo $palestra['id']; ?>)">Excluir</button></td>
           </tr>
   <?php
       }
      }
       else{
        echo "<tr><td colspan=\"6\">Nenhuma palestra encontrada!</td></tr>";
      }
   ?>

  </tbody>
</table>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 250px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="corpo">
        <p>Deseja realmente Excluir?</p>
      </div>
      <div class="modal-footer" style="justify-content: center;">
        <button type="button" class="btn btn-danger" id="btnSim">Sim</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
<?php include("rodape.php") ?>
<script>
$(document).ready(function() {
  ide = 0;
$('#btnSim').click(function(){
  var dados = "idpalestra="+ide;
  console.log(dados);
  $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'excluir.php',
                async: true,
                data: dados,
                success: function(response)
                {
                    location.reload();
                }
        });
    });
});
function abrirModal(id){
  $('#myModal').modal('show');
  ide = id;
  console.log(ide);
}
</script>
