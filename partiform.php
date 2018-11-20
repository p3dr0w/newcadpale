<?php include("cabecalho.php");

include_once 'conn.php';
if($_GET['tipo'] == 'incluir' || $_GET['tipo'] == 'editar'){
    $tipo = $_GET['tipo'];
    $idpalestra = $_GET['idpalestra'];
    if($tipo == 'editar' && $_GET['id'] != null && $_GET['nome'] != null && $_GET['email'] && $_GET['celular'] != null){
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $celular = $_GET['celular'];
    } else if($tipo != 'incluir'){
        header("location: index.php");
    }

    if(isset($_POST['nome']) && $tipo == 'incluir'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $celular = preg_replace('/[ ()-]/', '' , $celular);
        echo "<script> console.log($celular)</script>";

        $msg = '';
        try{
            $Conexao    = Conexao::getConnection();

            $query = $Conexao->prepare("insert into participante (nome, email, celular, idpalestra, del) values(:nome, :email, :celular, :idpalestra, b'0')");
            $query->execute(array(
                ':nome' => $nome,
                ':email' => $email,
                ':idpalestra' => (int)$idpalestra,
                ':celular' => $celular
            ));
            if($query->rowCount() > 0){
                echo "<script>
                alert('Participante cadastrado com sucesso!');
                window.location.href=window.localStorage.getItem('urlpalestradetalhe');;
                </script>";
            }
        }catch(Exception $e){
            $msg = $e->getMessage();
        echo "<script>alert('$msg');window.location.href='javascript:window.history.go(-2)'</script>";
            exit;
        }
  } elseif(isset($_POST['nome']) && $tipo == 'editar'){
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $celular = $_POST['celular'];
      $celular = preg_replace('/[ ()-]/', '' , $celular);

            try{
                $Conexao    = Conexao::getConnection();

                $query = $Conexao->prepare("update participante set nome = :nome, email = :email, celular = :celular where id = :id");
                $query->execute(array(
                    ':id' => $id,
                    ':nome' => $nome,
                    ':email' => $email,
                    ':celular' => $celular
                ));

                if($query->rowCount() > 0){
                    echo "<script>
                    alert('Participante alterado com sucesso!');
                    window.location.href=window.localStorage.getItem('urlpalestradetalhe');
                    </script>";
                }
            }catch(Exception $e){
                $msg = $e->getMessage();
                    echo "<script language='javascript' type='text/javascript'>alert('$msg');window.location.href='paledetail.php'</script>";
            }
    }
}
else{
    header("location: index.php");
}
?>
<main role="main">
      <div class="jumbotron" style="padding: 1rem 1rem;">
        <h1 class="mb-4" id="titulo">Cadastro do participante</h1>
        <form method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do participante" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email do participante" required>
        </div>
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" class="form-control" placeholder="Número do telefone" required>
        </div>
        <button type="submit" class="btn btn-success"><?php if($tipo == "incluir"){ echo "Adicionar"; } else{ echo "Alterar"; } ?></button>
        <a href="javascript:window.history.go(-1)" class="btn btn-danger">Voltar</a>
    </form>
      </div>
    </main>
<?php include("rodape.php");

if($tipo == "editar"){
  echo "<script>$(document).ready(function(){
      $(\"#nome\").val(\"$nome\");
      $(\"#email\").val(\"$email\");
      $(\"#celular\").val($celular);
      $(\"#celular\").mask('(00) 00000-0000');
      $(\"#titulo\").html(\"Adicionar Participante\");
      $(\"#subtitulo\").html(\"Participante <em><b> $nome </b></em>\");
      });</script>";
}
else{
  echo "<script>
    $(document).ready(function(){
    $(\"#celular\").mask('(00) 00000-0000');
    });
    </script>";
}
?>
