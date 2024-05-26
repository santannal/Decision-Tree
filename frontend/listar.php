<h3>HISTÓRICO</h3>


<table class="table shadow p-3 mb-5 bg-body-tertiary rounded">
    <thead class="thead" style="background-color: #DDA0DD;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descrição</th>
            <th scope="col">Ramal</th>
            <th>Opções</th>
        </tr>
    </thead>

    <tbody>
        <?php
        include_once '../class/Categoria.php';
        $cat = new Categoria();
        $dados = $cat->consultar();

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
                ?>
                <tr>
                    <th scope="row"><?= $mostrar['id'] ?></th>
                    <td><?= $mostrar['descricao'] ?></td>
                    <td><?= $mostrar['ramal'] ?></td>
                    <td>
                        <a href="?p=categoria/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=categoria/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger"
                            data-confirm="Excluir registro?">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>



    </tbody>
</table>

<div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0"
    aria-valuemax="100">
    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 75%; background-color: #FF69B4;">
    </div>
</div>