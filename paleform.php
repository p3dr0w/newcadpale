<?php include("cabecalho.php");

include_once 'conn.php';
if(isset($_GET['tipo'])){
    $tipo = $_GET['tipo'];
    if($tipo == 'editar'){
        $id = $_GET['id'];
        $palestra = $_GET['palestra'];
        $data = $_GET['data'];
        $palestrante = $_GET['palestrante'];
    }

    if(isset($_POST['palestra']) && $tipo == 'incluir'){
        $palestra = $_POST['palestra'];
        $data = $_POST['data'];
        $palestrante = $_POST['palestrante'];

        $msg = '';
        try{
            $Conexao    = Conexao::getConnection();

            $query = $Conexao->prepare("insert into palestra (nome, data, palestrante, del) values(:nome, :data, :palestrante, b'0')");
            $query->execute(array(
                ':nome' => $palestra,
                ':data' => $data,
                ':palestrante' => $palestrante
            ));
            if($query->rowCount() > 0){
                echo "<script language='javascript' type='text/javascript'>alert('Palestra cadastrada com sucesso!');window.location.href='index.php'</script>";
            }
        }
        catch(Exception $e){
            $msg = $e->getMessage();
        echo "<script language='javascript' type='text/javascript'>alert('$msg');window.location.href='index.php'</script>";
            exit;
        }
    } elseif(isset($_POST['palestra']) && $tipo == 'editar'){
            $palestra = $_POST['palestra'];
            $data = $_POST['data'];
            $palestrante = $_POST['palestrante'];

            try{
                $Conexao    = Conexao::getConnection();

                $query = $Conexao->prepare("update palestra set nome = :nome, data = :data, palestrante = :palestrante where id = :id");
                $query->execute(array(
                    ':id' => $id,
                    ':nome' => $palestra,
                    ':data' => $data,
                    ':palestrante' => $palestrante
                ));

                if($query->rowCount() > 0){
                    echo "<script language='javascript' type='text/javascript'>alert('Palestra alterada com sucesso!');window.location.href='index.php'</script>";
                }
            }
            catch(Exception $e){
                $msg = $e->getMessage();
                    echo "<script language='javascript' type='text/javascript'>alert('$msg');window.location.href='index.php'</script>";
            }
    }
}
else{
    header("location: index.php");
}
?>

<main role="main">
      <div class="jumbotron" style="padding: 1rem 1rem;">
        <h1 class ="mb-5" id="titulo">Cadastre um nova palestra</h1>

        <form method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="palestra" placeholder="Nome da palestra" required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" max="31/12/3000" id="data" min="01/01/1000" name="data" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="palestrante">Palestrante</label>
            <input type="text" class="form-control" id="palestrante" name="palestrante" placeholder="Nome do palestrante" required>
        </div>
        <button type="submit" class="btn btn btn-success"><?php if($tipo == "incluir"){ echo "Criar"; } else{ echo "Alterar"; } ?></button>
        <a href="index.php" class="btn btn-danger">Voltar</a>
    </form>
      </div>
    </main>

<?php include("rodape.php");
if($tipo == "editar"){
    echo "<script>$(document).ready(function(){
        $(\"#nome\").val(\"$palestra\");
        $(\"#data\").val(\"$data\");
        $(\"#palestrante\").val(\"$palestrante\");
        $(\"#titulo\").html(\"Alterar dados da palestra\");
        $(\"#subtitulo\").html(\"Palestra <em><b> $palestra </b></em>\");
        });</script>";
}

?>
