<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca CEP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Buscar informações de um CEP</h1>
        <form action="" method="POST">
            <label for="cep">Digite o CEP:</label>
            <input type="text" id="cep" name="cep" required pattern="\d{5}-?\d{3}" placeholder="Ex: 01001-000">
            <button type="submit">Buscar</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['cep'])) {
            $cep = preg_replace('/[^0-9]/', '', $_POST['cep']);
            $url = "https://viacep.com.br/ws/{$cep}/json/";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['erro']) && $data['erro'] === true) {
                echo "<p>CEP inválido. Tente novamente.</p>";
            } else {
                echo "<h2>Informações do CEP {$cep}:</h2>";
                echo "<ul>";
                echo "<li><strong>Logradouro:</strong> " . $data['logradouro'] . "</li>";
                echo "<li><strong>Complemento:</strong> " . $data['complemento'] . "</li>";
                echo "<li><strong>Unidade:</strong> " . $data['unidade'] . "</li>";
                echo "<li><strong>Bairro:</strong> " . $data['bairro'] . "</li>";
                echo "<li><strong>Localidade:</strong> " . $data['localidade'] . "</li>";
                echo "<li><strong>UF:</strong> " . $data['uf'] . "</li>";
                echo "<li><strong>IBGE:</strong> " . $data['ibge'] . "</li>";
                echo "<li><strong>GIA:</strong> " . $data['gia'] . "</li>";
                echo "<li><strong>DDD:</strong> " . $data['ddd'] . "</li>";
                echo "<li><strong>SIAFI:</strong> " . $data['siafi'] . "</li>";
                echo "</ul>";
            }
        }
        ?>
    </div>
</body>
</html>
