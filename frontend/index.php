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
        <p class="title-nav ml-2">FATEC-ITU</p>
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
    <?php
    include_once '../backend/Historico.php';

    $his = new Historico();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $precoCompra = filter_input(INPUT_POST, 'precoCompra', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $precoVenda = filter_input(INPUT_POST, 'precoVenda', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $perda = filter_input(INPUT_POST, 'perda', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $vendaChuva = filter_input(INPUT_POST, 'vendaChuva', FILTER_SANITIZE_NUMBER_INT);
        $vendaSol = filter_input(INPUT_POST, 'vendaSol', FILTER_SANITIZE_NUMBER_INT);
        $case1 = filter_input(INPUT_POST, '1caso', FILTER_SANITIZE_NUMBER_INT);
        $case2 = filter_input(INPUT_POST, '2caso', FILTER_SANITIZE_NUMBER_INT);
        $case3 = filter_input(INPUT_POST, '3caso', FILTER_SANITIZE_NUMBER_INT);
        $case4 = filter_input(INPUT_POST, '4caso', FILTER_SANITIZE_NUMBER_INT);

        $calcularLucroCase1 = $his->calcularLucro($case1, $precoCompra, $precoVenda, $perda, $vendaChuva, $vendaSol);
        $calcularLucroCase2 = $his->calcularLucro($case2, $precoCompra, $precoVenda, $perda, $vendaChuva, $vendaSol);
        $calcularLucroCase3 = $his->calcularLucro($case3, $precoCompra, $precoVenda, $perda, $vendaChuva, $vendaSol);
        $calcularLucroCase4 = $his->calcularLucro($case4, $precoCompra, $precoVenda, $perda, $vendaChuva, $vendaSol);

        $dados = array(
            'precoCompra' => $precoCompra,
            'precoVenda' => $precoVenda,
            'perda' => $perda,
            'vendaChuva' => $vendaChuva,
            'vendaSol' => $vendaSol,
            'calculo1case' => $calcularLucroCase1,
            'calculo2case' => $calcularLucroCase2,
            'calculo3case' => $calcularLucroCase3,
            'calculo4case' => $calcularLucroCase4,
        );

        $his->setDadosJson(json_encode($dados));
        $salvarFirebase = $his->salvarFirebase();

        if ($salvarFirebase) {
            $msg = '<div class="alert alert-info" role="alert"> <h2>RESPOSTAS</h2> <br> <p>Decisão 1:' . $calcularLucroCase1 . '</p>' .
                '<p>Decisão 2:' . $calcularLucroCase2 . '</p>' .
                '<p>Decisão 3:' . $calcularLucroCase3 . '</p>' .
                '<p>Decisão 4:' . $calcularLucroCase4 . '</p></div>';
        } else {
            $msg = '<div class="alert alert-danger">Falha ao salvar os dados!</div>';
        }
    }
    ?>

    <div class="container table mt-5 bg-light shadow-lg">
        <div id="pai">
            <h1 class="text-center">Tabela de Decisões</h1>
            <?php if (!empty($msg))
                echo $msg; ?>
            <form id="decisionForm" class="mt-4" method="post" action="">
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
                <div class="testecases d-flex">
                    <div class="form-group m-2">
                        <label for="vendaSol">Primeiro teste: </label>
                        <input type="number" class="form-control" id="1caso" name="1caso" required>
                    </div>
                    <div class="form-group m-2">
                        <label for="vendaSol">Segundo teste: </label>
                        <input type="number" class="form-control" id="2caso" name="2caso" required>
                    </div>
                    <div class="form-group m-2">
                        <label for="vendaSol">Terceiro teste: </label>
                        <input type="number" class="form-control" id="3caso" name="3caso" required>
                    </div>
                    <div class="form-group m-2">
                        <label for="vendaSol">Quarto teste: </label>
                        <input type="number" class="form-control" id="4caso" name="4caso" required>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary shadow mt-5" name="btnsalvar">Calcular Decisão</button>
                </div>
            </form>
            <div id="resultado" class="mt-4"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
</body>

</html>