<?php require_once('./verificar_sessao.php'); ?>
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
                                <a class="nav-link disabled" href="#LoGiN">Olá <?php echo $_SESSION['user']; ?>!</a>
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

            <h3> Formulário de Cadastro</h3>
            <hr/>

            <form name="cad_filmes" action="exec_cadastro.php" method="POST" enctype="multipart/form-data">
                <div class="form-group" disabled>
                    <label>Código:</label>
                    <input type="text" name="codigo"  class="form-control col-sm-6" disabled>
                </div>
                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo"  class="form-control col-sm-6" required>
                </div>
                <div class="form-group">
                    <label>Gênero: </label>
                    <div class="form-control col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Ação">
                            <label class="form-check-label">Ação</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Animação">
                            <label class="form-check-label">Animação</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Aventura">
                            <label class="form-check-label">Aventura</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Comédia">
                            <label class="form-check-label">Comédia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Documentário">
                            <label class="form-check-label">Documentário</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Guerra">
                            <label class="form-check-label">Guerra</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Fantasia">
                            <label class="form-check-label">Fantasia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Musical">
                            <label class="form-check-label">Musical</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Suspense">
                            <label class="form-check-label">Suspense</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"  name="genero[]" type="checkbox" value="Terror">
                            <label class="form-check-label">Terror</label>
                        </div>
                    </div> 
                </div>
                <div class="form-group">
                    <label>Produtora:</label>
                    <input type="text" name="produtora"  class="form-control col-sm-6" required>
                </div>
                <div class="form-group">
                    <label>Diretor:</label>
                    <input type="text" name="diretor"  class="form-control col-sm-6" required>
                </div>
                <div class="form-group">
                    <label>Atores:</label>
                    <div class="input-group mb-1 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">1º</span>
                        </div>
                        <input type="text" name="atores[]"  class="form-control " required>
                    </div>
                    <div class="input-group mb-1 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">2º</span>
                        </div>
                        <input type="text" name="atores[]"  class="form-control ">
                    </div>
                    <div class="input-group mb-1 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">3º</span>
                        </div>
                        <input type="text" name="atores[]"  class="form-control ">
                    </div>
                    <div class="input-group mb-1 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">4º</span>
                        </div>
                        <input type="text" name="atores[]"  class="form-control ">
                    </div>
                    <div class="input-group mb-1 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">5º</span>
                        </div>
                        <input type="text" name="atores[]"  class="form-control ">
                    </div>
                    <!--input type="text" name="atores[]"  class="form-control col-sm-6">
                    <input type="text" name="atores[]"  class="form-control col-sm-6">
                    <input type="text" name="atores[]"  class="form-control col-sm-6">
                    <input type="text" name="atores[]"  class="form-control col-sm-6">
                    <input type="text" name="atores[]"  class="form-control col-sm-6"-->
                </div>
                <div class="form-group">
                    <label>Classificação:</label>
                    <!--input type="text" name="classificacao"  class="form-control col-sm-6" required-->
                    <select name="classificacao" class="form-control col-sm-6" required>
                        <option></option>
                        <option>Livre</option>
                        <option>10 anos</option>  
                        <option>12 anos</option>
                        <option>14 anos</option>
                        <option>16 anos</option>
                        <option>18 anos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ano:</label>
                    <input type="number" min="0" max="9999" name="ano"  class="form-control col-sm-6" required>
                </div>
                <div class="form-group">
                    <label>Capa:</label>
                    <div class="img">
                        <img id="preview" src="imagens/sem_foto.png" width="100px" height="100px" class="img-fluid img-thumbnail" alt="Capa do Filme">
                    </div>
                    <input id="arquivo" name="arquivo" type="file" class="form-control col-sm-6"/>
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

                <input type="submit" class="btn btn-primary"  id="btn_submit" value="Salvar" />
                <a href="lista_cadastro.php" class="btn btn-light"  id="btn_voltar" value="Cancelar">Cancelar</a>
            </form>

            <hr>
            <footer>
                <p>&copy;2019 - Linguagens de Programação I</p>
            </footer>
        </div> <!-- /container -->
    </body>
</html>
