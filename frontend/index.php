<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Decisão</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-opacity-0 mt-3">
        <a class="title-nav ml-2" href="#">FATEC-ITU</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-5" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link m-2" href="#">Calcular</a></li>
                <li class="nav-item"><a class="nav-link m-2" href="listar.php">Histórico</a></li>
            </ul>
        </div>
    </nav>
</header>

<body>
    <div class="container table mt-5 bg-light shadow-lg">
        <div id="pai">
            <h1 class="text-center">Tabela de Decisões</h1>
            <form id="decisionForm" class="mt-4" method="post">
                <div class="form-group">
                    <label for="precoCompra">Preço de Compra (R$):</label>
                    <input type="number" step="0.01" class="form-control" id="precoCompra" name="precoCompra" required>
                </div>
                <div class="form-group">
                    <label for="precoVenda">Preço de Venda (R$):</label>
                    <input type="number" step="0.01" class="form-control" id="precoVenda" name="precoVenda" required>
                </div>
                <div class="form-group">
                    <label for="perda">Perda (%):</label>
                    <input type="number" step="0.01" class="form-control" id="perda" name="perda" required>
                </div>
                <div class="form-group">
                    <label for="vendaChuva">Venda em Dias Normais:</label>
                    <input type="number" class="form-control" id="vendaChuva" name="vendaChuva" required>
                </div>
                <div class="form-group">
                    <label for="vendaSol">Venda em Dias com Ocasiões Especiais:</label>
                    <input type="number" class="form-control" id="vendaSol" name="vendaSol" required>
                </div>
                <button type="submit" class="btn btn-primary" name="btnsalvar">Calcular Decisão</button>
            </form>
            <div id="resultado" class="mt-4"></div>
        </div>
    </div>

    <?php
    // Inclua o código PHP antes do HTML
    $id = filter_input(INPUT_GET, 'id');
    include_once '../backend/Historico.php';
    $his = new Historico();

    // Verifique se o botão salvar foi pressionado
    if (filter_input(INPUT_POST, 'btnsalvar')) {
        // Obtenha os valores do formulário
        $precoCompra = filter_input(INPUT_POST, 'precoCompra');
        $precoVenda = filter_input(INPUT_POST, 'precoVenda');
        $perda = filter_input(INPUT_POST, 'perda');
        $vendaChuva = filter_input(INPUT_POST, 'vendaChuva');
        $vendaSol = filter_input(INPUT_POST, 'vendaSol');

        // Crie um array com os dados
        $dados = array(
            'precoCompra' => $precoCompra,
            'precoVenda' => $precoVenda,
            'perda' => $perda,
            'vendaChuva' => $vendaChuva,
            'vendaSol' => $vendaSol
        );

        // Defina os dados JSON na instância de Historico
        $his->setDadosJson(json_encode($dados));

        // Salve os dados no Firebase
        $salvarFirebase = $his->salvarFirebase();
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com