<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['cliente'];
    $valor_metro_quadrado = floatval($_POST['valor_metro_quadrado']);

    // Simulação de upload de logo (mantido fixo)
    $logo_path = 'uploads/logo.png'; // Coloque o caminho correto da logo aqui

    // Áreas
    $areas = [];
    foreach ($_POST['area_nome'] as $index => $nome) {
        $altura = floatval($_POST['area_altura'][$index]);
        $largura = floatval($_POST['area_largura'][$index]);
        
        // Áreas de portas e janelas
        $area_porta = floatval($_POST['area_porta'][$index]);
        $area_janela = floatval($_POST['area_janela'][$index]);
        
        // Área líquida da parede (descontando portas e janelas)
        $area_liq = ($altura * $largura) - $area_porta - $area_janela;
        
        // Calcular o valor da área considerando o valor por metro quadrado
        $valor_area = $area_liq * $valor_metro_quadrado;

        // Salvar os dados da área no array
        $areas[] = [
            'nome' => $nome,
            'altura' => $altura,
            'largura' => $largura,
            'valor_area' => $valor_area
        ];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Orçamento de Pintura - Rocha Pinturas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }
        .link {
            margin-top: 20px;
            font-size: 14px;
        }
        .print-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="<?php echo $logo_path; ?>" alt="Logo da Rocha Pinturas">
        <h2>Rocha Pinturas</h2>
        <h3>Resumo do Orçamento</h3>
        <p><strong>Cliente:</strong> <?php echo $cliente; ?></p>
        <p><strong>Valor por Metro Quadrado:</strong> R$ <?php echo number_format($valor_metro_quadrado, 2, ',', '.'); ?></p>
        <h3>Áreas:</h3>
        <?php foreach ($areas as $area): ?>
            <p><?php echo $area['nome']; ?>: <?php echo $area['altura']; ?> m x <?php echo $area['largura']; ?> m - Valor: R$ <?php echo number_format($area['valor_area'], 2, ',', '.'); ?></p>
        <?php endforeach; ?>
        <p>Total de Metros Quadrados: <?php echo number_format(array_sum(array_column($areas, 'altura') * array_column($areas, 'largura')), 2, ',', '.'); ?> m²</p>
        <p>Valor Total do Orçamento: R$ <?php echo number_format(array_sum(array_column($areas, 'valor_area')), 2, ',', '.'); ?></p>
        <button class="print-button" onclick="window.print()">Imprimir Orçamento</button>
        <p><a class="link" href="http://www.rochapinturas.com" target="_blank">Visite nosso site</a></p>
    </div>
</body>
</html>

<?php
} // Fim do bloco if ($_SERVER["REQUEST_METHOD"] == "POST")
?>
