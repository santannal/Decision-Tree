<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-opacity-0 mt-3">
        <p class="title-nav ml-2">FATEC-ITU</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-5" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link m-2" href="index.php">Calcular</a></li>
                <li class="nav-item"><a class="nav-link m-2" href="#">Histórico</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="div-title mt-3">
    <p>HISTÓRICO</p>
</div>
<div class="row row-cols-1 row-cols-md-2 g-4">
    <?php
    include_once './../backend/Historico.php';
    $cat = new Historico();
    $dados = $cat->listarFirebase();

    if (!empty($dados)) {
        foreach ($dados as $mostrar) {
            ?>
            <div class="col">
                <div class="card-group mt-5 shadow bg-light">
                    <div class="card-body">
                        <p class="card-text" style="font-size: 30px">Valores inseridos: </p>
                        <p class="mt-3">Preço compra:
                            <?= $mostrar['precoCompra'] ?>
                        </p>
                        <p class="card-text">Preço venda: <?= $mostrar['precoVenda'] ?></p>
                        <p class="card-text">Perda: <?= $mostrar['perda'] ?>%</p>
                        <p class="card-text">Venda chuva: <?= $mostrar['vendaChuva'] ?></p>
                        <p class="card-text">Venda Sol: <?= $mostrar['vendaSol'] ?></p>
                        <p class="card-text mt-4" style="font-size: 30px">RESPOSTAS: </p>
                        <p class="card-text">Análise 1: <?= $mostrar['calculo1case'] ?></p>
                        <p class="card-text">Análise 2: <?= $mostrar['calculo2case'] ?></p>
                        <p class="card-text">Análise 3: <?= $mostrar['calculo3case'] ?></p>
                        <p class="card-text">Análise 4: <?= $mostrar['calculo4case'] ?></p>
                    </div>
                </div>
            </div>


            <?php
        }
    }
    ?>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

</tbody>
</table>