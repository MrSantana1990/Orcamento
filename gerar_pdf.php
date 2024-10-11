<?php
require_once('scripts/fpdf/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $cliente = $_GET['cliente'] ?? '';
    $valor_metro_quadrado = floatval($_GET['valor_metro_quadrado'] ?? 0);
    $areas_json = $_GET['areas'] ?? '[]'; // Defina como array vazio se não estiver definida

    // Decodificar o JSON das áreas
    $areas = json_decode($areas_json, true); // true para obter como array associativo

    // Defina o caminho correto da logo aqui
    $logo_path = 'uploads/logo.png'; // Ajuste conforme necessário

    // Cria uma nova instância do FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Configurações de fonte e cor
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0); // Cor do texto (preto)

    // Título
    $pdf->Cell(0, 10, utf8_decode('Orçamento da Empresa Rocha Pinturas'), 0, 1, 'C');
    $pdf->Ln(10); // Espaço vertical

    // Informações do Cliente
    $pdf->Cell(0, 10, utf8_decode("Cliente: $cliente"), 0, 1, 'L');

    // Valor por Metro Quadrado
    $pdf->Cell(0, 10, utf8_decode("Valor por Metro Quadrado: R$ " . number_format($valor_metro_quadrado, 2, ',', '.')), 0, 1, 'L');

    // Logo da Empresa
    if (!empty($logo_path) && file_exists($logo_path)) {
        $pdf->Image($logo_path, 80, 25, 50); // Posição e tamanho da imagem
    } else {
        $pdf->Cell(0, 10, 'Logo não encontrada', 0, 1, 'L');
    }

    // Áreas (se houver)
    if (!empty($areas)) {
        $pdf->Ln(10); // Espaço vertical

        foreach ($areas as $area) {
            $nome = $area['nome'] ?? '';
            $altura = $area['altura'] ?? '';
            $largura = $area['largura'] ?? '';
            $pdf->Cell(0, 10, utf8_decode("$nome: $altura m x $largura m"), 0, 1, 'L');
        }
    } else {
        $pdf->Cell(0, 10, 'Nenhuma área foi adicionada.', 0, 1, 'L');
    }

    // Nome do arquivo para download
    $pdf_filename = 'orcamento.pdf';

    // Saída do PDF para o navegador
    $pdf->Output('D', $pdf_filename);
    exit();
}
?>
