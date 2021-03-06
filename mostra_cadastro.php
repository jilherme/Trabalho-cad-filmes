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

            <h3> Registro Cadastrado</h3>
            <hr/>

            <?php
            require_once('conectar.php');

//Obt??m valores enviados por POST da p??gina lista_cadastro
            $codigo = $_GET['codigo'];

            $sql = "SELECT * FROM filme WHERE codigo='$codigo'";
            $retorno = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($retorno) > 0) {
                $registro = mysqli_fetch_assoc($retorno);
                mysqli_close($conexao);
            } else {
                $msg = "Error: " . $sql . "<br>" . mysqli_error($conexao);
                mysqli_close($conexao);
                header("location: lista_cadastro.php?retorno=$msg");
            }

//Recupera valores dos g??neros dos filmes.
            $genero = explode("/", $registro['genero']);

//Recupera valores dos Atores dos filmes.
            $atores = explode(", ", $registro['atores']);
            ?>

            <div class="form-group" disabled>
                <label>C??digo:</label>
                <input type="text" name="codigo"  class="form-control col-sm-6" value="<?php echo $registro['codigo']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>T??tulo:</label>
                <input type="text" name="titulo"  class="form-control col-sm-6" value="<?php echo $registro['titulo']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>G??nero: </label>
                <div class="form-control col-sm-6" >
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="A????o" <?php echo (in_array("A????o", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">A????o</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Anima????o" <?php echo (in_array("Anima????o", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Anima????o</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Aventura" <?php echo (in_array("Aventura", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Aventura</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Com??dia" <?php echo (in_array("Com??dia", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Com??dia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Document??rio" <?php echo (in_array("Document??rio", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Document??rio</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Guerra" <?php echo (in_array("Guerra", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Guerra</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Fantasia" <?php echo (in_array("Fantasia", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Fantasia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Musical" <?php echo (in_array("Musical", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Musical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Suspense" <?php echo (in_array("Suspense", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Suspense</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  name="genero[]" type="checkbox" value="Terror" <?php echo (in_array("Terror", $genero) ? "checked" : null); ?> disabled>
                        <label class="form-check-label">Terror</label>
                    </div>
                </div> 
            </div>
            <div class="form-group">
                <label>Produtora:</label>
                <input type="text" name="produtora"  class="form-control col-sm-6" value="<?php echo $registro['produtora']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Diretor:</label>
                <input type="text" name="diretor"  class="form-control col-sm-6" value="<?php echo $registro['diretor']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Atores:</label>
                <div class="input-group mb-1 col-sm-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text">1??</span>
                    </div>
                    <input type="text" name="atores[]"  class="form-control " value="<?php echo (isset($atores[0]) ? $atores[0] : null); ?>" disabled>
                </div>
                <div class="input-group mb-1 col-sm-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text">2??</span>
                    </div>
                    <input type="text" name="atores[]"  class="form-control " value="<?php echo (isset($atores[1]) ? $atores[1] : null); ?>" disabled>
                </div>
                <div class="input-group mb-1 col-sm-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text">3??</span>
                    </div>
                    <input type="text" name="atores[]"  class="form-control " value="<?php echo (isset($atores[2]) ? $atores[2] : null); ?>" disabled>
                </div>
                <div class="input-group mb-1 col-sm-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text">4??</span>
                    </div>
                    <input type="text" name="atores[]"  class="form-control " value="<?php echo (isset($atores[3]) ? $atores[3] : null); ?>" disabled>
                </div>
                <div class="input-group mb-1 col-sm-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text">5??</span>
                    </div>
                    <input type="text" name="atores[]"  class="form-control " value="<?php echo (isset($atores[4]) ? $atores[4] : null); ?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label>Classifica????o:</label>
                <!--input type="text" name="classificacao"  class="form-control col-sm-6" required-->
                <select name="classificacao" class="form-control col-sm-6" disabled>
                    <option></option>
                    <!-- DECLARACAO IF 01 -> maneira de declarar um IF para marcar campo SELECT com o atributo "selected"-->
                    <option <?php if ($registro['classificacao'] == 'Livre'): ?> selected="selected"<?php endif; ?>>Livre</option> 
                    <!-- DECLARACAO IF 02 -> maneira de declarar um IF para marcar campo do tipo "select" com o atributo "selected"-->
                    <option <?php echo (($registro['classificacao'] == '10 anos') ? 'selected="selected"' : null); ?>>10 anos</option>  
                    <option <?php echo (($registro['classificacao'] == '12 anos') ? 'selected="selected"' : null); ?>>12 anos</option>
                    <option <?php echo (($registro['classificacao'] == '14 anos') ? 'selected="selected"' : null); ?>>14 anos</option>
                    <option <?php echo (($registro['classificacao'] == '16 anos') ? 'selected="selected"' : null); ?>>16 anos</option>
                    <option <?php echo (($registro['classificacao'] == '18 anos') ? 'selected="selected"' : null); ?>>18 anos</option>
                </select>
            </div>
            <div class="form-group">
                <label>Ano:</label>
                <input type="number" min="0" max="9999" name="ano"  class="form-control col-sm-6" value="<?php echo $registro['ano']; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Capa:</label>
                <div class="img">
                    <img id="preview" src="<?php echo $registro['capa']; ?>" width="100px" height="100px" class="img-fluid img-thumbnail" alt="Capa do Filme" disabled>
                </div>
                <input id="arquivo" name="arquivo" type="file" class="form-control col-sm-6" disabled/>          
                <script>
                    function readImage() {
                        if (this.files && this.files[0]) {
                            var file = new FileReader();
                            file.onload = function (e) {
                                document.getElementById("preview").src = e.target.result;
                            };
                            file.readAsDataURL(this.files[0]);
                        }
                    }
                    document.getElementById("arquivo").addEventListener("change", readImage, false);
                </script>  
            </div>


            <a href="edita_cadastro.php?codigo=<?php echo $registro['codigo']; ?>" class="btn btn-primary"  id="btn_voltar" value="Editar">Editar</a>
            <a href="lista_cadastro.php" class="btn btn-light"  id="btn_voltar" value="Voltar">Voltar</a>


            <hr>
            <footer>
                <p>&copy;2019 - Linguagens de Programa????o I</p>
            </footer>
        </div> <!-- /container -->
    </body>
</html>