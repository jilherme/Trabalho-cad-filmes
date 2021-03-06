<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body {
                padding-top: 80px;
                padding-bottom: 20px;
            }
        </style>
        <title>Sistema Cadastro de Filmes</title>
    </head>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="index.php">CadFilmes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="form_cadastro.php">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_cadastro.php">Lista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="relatorio_pdf.php">Gerar Relat??rio</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <?php if (isset($_SESSION['login']) && isset($_SESSION['user']) && isset($_COOKIE["login"])) { ?>
                        <?php if (isset($_SESSION) && ($_SESSION['login'] == 'LOGIN_EFETUADO')) { ?>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#LoGiN">Ol?? <?php echo $_SESSION['user']; ?>!</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Sair</a>
                            </li>
                        <?php }; ?>
                    <?php }; ?>
                </ul>
            </div>
        </nav>
    </header>
    <body>

        <div class="container">

            <h3> Lista Cadastro</h3>


            <?php
            require_once('conectar.php');

            $sql = "SELECT * FROM filme";
            $retorno = mysqli_query($conexao, $sql);

            mysqli_close($conexao);
            ?>

            <!-- ##########################################################################
            // Forma mais elaborada de mostrar registros            
            ############################################################################--> 
            <hr>
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Capa</th>
                        <th>T??tulo</th>
                        <th>G??nero</th>
                        <th>Classifica????o</th>
                        <th>Ano</th>
                        <th>Op????es</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($retorno) > 0) { ?>
                        <?php foreach ($retorno as $registro) { ?>
                            <tr>
                                <td><img src="<?php echo $registro['capa']; ?>" width="100px" height="150px" class="img-fluid img-thumbnail"/></td>
                                <td><?php echo $registro['titulo']; ?></td>
                                <td><?php echo $registro['genero']; ?></td>
                                <td><?php echo $registro['classificacao']; ?></td>
                                <td><?php echo $registro['ano']; ?></td>
                                <td class="actions text-center">
                                    <a href="mostra_cadastro.php?codigo=<?php echo $registro['codigo']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar </a>
                                    <a href="edita_cadastro.php?codigo=<?php echo $registro['codigo']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar </a>
                                    <a href="exclui_cadastro.php?codigo=<?php echo $registro['codigo']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-eraser"></i> Excluir </a>
                                </td>
                            </tr>
                        <?php }; ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>

            <?php if (isset($_GET['status'])) { ?>
                <div style="position: fixed; bottom: 10px; left:2%; width: 96%;">
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong> <?php echo $_GET['status'] . "!" ?></strong>
                    </div>
                </div>
                <?php
            }
            ?>

            <hr>
            <footer>
                <p>&copy;2019 - Linguagens de Programa????o I</p>
            </footer>
        </div> <!-- /container -->
    </body>
</html>