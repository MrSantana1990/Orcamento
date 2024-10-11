<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Orçamento de Pintura</title>
</head>
<body>
    <h1>Orçamento de Pintura</h1>
    <form action="processar_orcamento.php" method="post" enctype="multipart/form-data">
        <label>Nome do Cliente: <input type="text" name="cliente" required></label><br>
        <label>Valor por Metro Quadrado: <input type="number" step="0.01" name="valor_metro_quadrado" required></label><br>
        <label>Logo da Empresa: <input type="file" name="logo"></label><br>
        <div id="areas-container"></div>
        <button type="button" onclick="adicionarArea()">Adicionar Área</button><br>
        <input type="submit" value="Gerar Orçamento">
    </form>

    <script>
        function adicionarArea() {
            const areasContainer = document.getElementById('areas-container');
            const novaArea = document.createElement('div');
            novaArea.innerHTML = `
                <label>Nome da Área: <input type="text" name="area_nome[]" required></label>
                <label>Altura (m): <input type="number" step="0.01" name="area_altura[]" required></label>
                <label>Largura (m): <input type="number" step="0.01" name="area_largura[]" required></label>
                <hr>
            `;
            areasContainer.appendChild(novaArea);
        }
    </script>
</body>
</html>
