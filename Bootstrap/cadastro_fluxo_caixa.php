<?php
    include('conexao.php');

    //Upload da foto
    $fotoNome = $_FILES['foto']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);

    //Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    //Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");


    //Check entension
    if(in_array($imageFileType, $extensions_arr))
    {
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir.$fotoNome))
        {
            $fotoBlob = addslashes(file_get_contents($target_dir.$fotoNome));
        }
    }

    $data = $_POST['data'];
    $tipo = $_POST['opcTipo'];
    $valor = $_POST['valor'];
    $historico = $_POST['historico'];
    $cheque = $_POST['cheque'];

    echo "Data: ".$data."<br>"
    ."Tipo: ".$tipo."<br>"
    ."Valor: ".$valor."<br>"
    ."Histórico: ".$historico."<br>"
    ."Cheque: ".$cheque;

    $sql = "INSERT INTO  fluxo_caixa (data, tipo, valor, historico, cheque, foto_blob, foto_nome)
                VALUES ('".$data."', '".$tipo."', '".$valor."', '".$historico."', '".$cheque."', '".$fotoBlob."', '".$fotoNome."')";

    $result = mysqli_query($con, $sql);

    if($result)
    {
        echo "<br><br>Dados inseridos com sucesso!";
    }
    else
    {
        echo "<br><br>Erro ao inserir oo banco de dados: ".mysqli_error($con);
    }
?>
<br><br><a href="index.php">Voltar</a>