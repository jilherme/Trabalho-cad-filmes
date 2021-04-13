<?php require_once('conectar.php');

//$cod_proj = $_POST['codigo']; //Não é necessário porque é autoincremento na tabela;
$titulo = $_POST['titulo'];
$genero = implode('/', $_POST['genero']);
$produtora = $_POST['produtora'];
$diretor = $_POST['diretor'];
$atores = implode(', ', $_POST['atores']);
$classificacao = $_POST['classificacao'];
$ano = $_POST['ano'];
$msg = "";

// verifica se foi enviado um arquivo
if (isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0) {

    $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
    $nome = $_FILES['arquivo']['name'];

    // Pega a extensão
    $extensao = pathinfo($nome, PATHINFO_EXTENSION);

    // Converte a extensão para minúsculo
    $extensao = strtolower($extensao);

    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {     
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;

        // Concatena a pasta com o nome
        $destino = 'capas/' . $novoNome;

        // tenta mover o arquivo para o destino
        if (@move_uploaded_file($arquivo_tmp, $destino)) {
            $msg += 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            $msg += ' < img src = "' . $destino . '" />';
        } else
            $msg += 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    } else
        $msg += 'Extensão inválida "*.jpg;*.jpeg;*.gif;*.png"<br />';
}

//Se ocorrer erro ou não for enviada capa para o filme é atribuida uma imagem padrão a capa
$capa = isset($destino) ? $destino : 'imagens/sem_foto.png';

$sql = "INSERT INTO filme (titulo, genero, produtora, diretor, atores, classificacao, ano, capa) 
        VALUES ('$titulo', '$genero', '$produtora', '$diretor', '$atores', '$classificacao', '$ano', '$capa')";


if (mysqli_query($conexao, $sql)) {
    mysqli_close($conexao);
    header("location: lista_cadastro.php");
} else {
    $msg += "Error: " . $sql . "<br>" . mysqli_error($conexao);
    mysqli_close($conexao);
    header("location: lista_cadastro.php?status=$msg");
}?>
