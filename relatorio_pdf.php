<?php

//fPFP tem problemas com o padrão UTF-8, uma solução para uso seria seguir o que diz na FAQ:
//http://www.fpdf.org/en/FAQ.php#q3

require_once('conectar.php');

$sql = "SELECT * FROM filme";
$retorno = mysqli_query($conexao, $sql);
$linhas = mysqli_num_rows($retorno);

//Verificamos se a consulta retornou alguma linha
if ($linhas > 0) {
//logotipo do relatório
    $imagem = "imagens/sessao-abc-logo.png";
//Endereço da biblioteca fpdf
    $end_fpdf = "fpdf181/";
//Número de resultados por página
    $por_pagina = 29;
//Endereço onde será gerado o arquivo pdf
    $end_final = "relatório_filmes.pdf";
//Tipo de pdf gerado
//D envia para o browser e força o download do arquivo com o nome indicado por name.
//F salva em um arquivo local com o nome informado em name.
//I envia o arquivo diretamente para o browser. Se o plug-in estiver instalado ele será usado.
    $tipo_pdf = "I";
//Calcular quantas páginas serão necessárias
//ceil() arredonda um número float para cima ex.: 8.2 = 9
    $paginas = ceil($linhas / $por_pagina);
//Preparar para gerar o pdf
    define("FPDF_FONTPATH", "$end_fpdf/font/");
    require_once("$end_fpdf/fpdf.php");
    $pdf = new FPDF(); //instancia a classe FPDF
//Inicializa as variáveis
    $linha_atual = 0;
    $inicio = 0;
//comando for para controlar o total de páginas necessárias para o relatório
    for ($x = 1; $x <= $paginas; $x++) {
//controlar o numero de registros por pagina (29 por folha A4)
        $inicio = $linha_atual;
        $fim = $linha_atual + $por_pagina;
        if ($fim > $linhas) {
            $fim = $linhas;
        }
        //$pdf->Open(); deprecated
        $pdf->AddPage();
        $pdf->SetAuthor("Linguagens I", 1);
        $pdf->SetFont("Arial", "B", 10);
        $pdf->Image($imagem, 15, 8, 20, 20); //posição alinhamento coluna-linha
        $pdf->Ln(2);
//número da página do relatório e a posição L "left" - 
//R "right" ou C "center"
//primeiro parametro = 1 indica borda ao redor do texto
//segundo parametro = 1 espaço abaixo do texto (quebra de linha)
        $pdf->Cell(185, 8, "Pagina $x de $paginas", 0, 0, 'R');
//titulo do relatorio
        $pdf->SetFont("Helvetica", "BI", 30);
        $pdf->Cell(-180, 20, "Lista de Filmes", 0, 0, 'C');
        $pdf->SetFont("Arial", "BI", 10);
        $pdf->SetFillColor(255,0,255);
//quebra de linha
        $pdf->Ln(20);
//Montar o cabeçalho do relatorio
        $pdf->Cell(8, 8, "Cod.", 1, 0, 'C');
        $pdf->Cell(100, 8, utf8_decode("Título"), 1, 0, 'L');
        $pdf->Cell(40, 8, utf8_decode("Gênero"), 1, 0, 'L');
        $pdf->Cell(25, 8, utf8_decode("Classificação"), 1, 0, 'L');
        $pdf->Cell(10, 8, "Ano", 1, 1, 'L');
        $pdf->SetFont("Arial", "", 10);
//comando for para exibir os registros
        for ($i = $inicio; $i < $fim; $i++) {
            //Ajusta o ponteiro do resultado para uma linha arbritaria no conjunto de resutados
            mysqli_data_seek($retorno, $i);
            //Obtem uma linha do resultado como uma matriz associativa, numérica, ou ambas
            $linha = mysqli_fetch_array($retorno);
            $pdf->Cell(8, 8, $linha['codigo'], 1, 0, 'C');
            $pdf->Cell(100, 8, utf8_decode($linha['titulo']), 1, 0, 'L');
            $pdf->Cell(40, 8, utf8_decode($linha['genero']), 1, 0, 'L');
            $pdf->Cell(25, 8, utf8_decode($linha['classificacao']), 1, 0, 'L');
            $pdf->Cell(10, 8, $linha['ano'], 1, 1, 'L');
            $linha_atual++;
        }//fecha FOR (Registros - i)
    } //fecha FOR (Paginas - x)
//Saida do PDF
//$pdf->Output("$end_final", "$tipo_pdf");
    $pdf->Output($end_final, $tipo_pdf, true);

    echo "<font color='blue' size='5'>";
    echo "Relatorio gerado com sucesso ! ";
    echo "</font>";
} else {
    echo "Nenhum registro encontrado";
    die;
}
?>