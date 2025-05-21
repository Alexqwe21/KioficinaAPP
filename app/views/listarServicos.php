<!DOCTYPE html>
<html lang="pt-br">

<?php require_once('template/head.php') ?>

<body>
    <main>

        <section class="listarServicos container lista">

            <h2 class="titulo">
                LISTA DE
                <span>SERVIÇOS</span>
            </h2>

            <div class="container_itens">

                <?php
                if (!empty($servicos) && is_array($servicos)) {
                    foreach ($servicos as $servico) {
                        $statusClass = '';
                        switch ($servico['status_ordem']) {
                            case 'Em análise':
                                $statusClass = 'textRed';
                                break;
                            case 'Em andamento':
                                $statusClass = 'textYellow';
                                break;
                            case 'Concluído':
                                $statusClass = 'textGreen';
                                break;
                        }
                ?>

                        <article class="box_item">
                            <p><strong>Data de Entrada: </strong><?= date('d/m/Y H:i', strtotime($servico['data_abertura_ordem'])) ?></p>
                            <p><strong>Previsão de Saída: </strong><?= date('d/m/Y H:i', strtotime($servico['data_fechamento_ordem'])) ?></p>
                            <p><strong>Marca:</strong> <?= $servico['nome_marca'] ?></p>
                            <p><strong>Modelo:</strong> <?= $servico['nome_modelo'] ?></p>
                            <p><strong>Chassi:</strong> <?= $servico['chassi_veiculo'] ?></p>
                            <p><strong>Observação:</strong> <?= $servico['obs_ordem'] ?></p>
                            <p><strong>Total:</strong> <?= $servico['valor_total_ordem'] ?></p>
                            <p class="status <?= $statusClass ?>">STATUS: <span> <?= $servico['status_ordem'] ?> </span></p>
                        </article>

                <?php
                    }
                } else {
                    echo "<p>Nenhum serviço encontrado!</p>";
                }
                ?>

            </div>

            <a href="<?php echo BASE_URL ?>index.php?url=home" class="btnApp btnVoltar">VOLTAR</a>

        </section>

    </main>
</body>

</html>