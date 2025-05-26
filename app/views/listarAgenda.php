<!DOCTYPE html>
<html lang="pt-br">

<?php require_once('template/head.php') ?>

<body>
    <main>

        <section class="listarAgenda container lista">

            <h2 class="titulo">
                LISTA DE
                <span>AGENDAMENTOS</span>
            </h2>

            <?php if (isset($_SESSION['msg_sucesso'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['msg_sucesso']; ?>
                    <?php unset($_SESSION['msg_sucesso']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['msg_erro'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['msg_erro']; ?>
                    <?php unset($_SESSION['msg_erro']); ?>
                </div>
            <?php endif; ?>




            <div class="container_itens">

                <?php
                if (!empty($agendamentos) && is_array($agendamentos)) {
                    foreach ($agendamentos as $agendamento) {
                        $statusClass = '';
                        switch ($agendamento['status_agendamento']) {
                            case 'Em análise':
                                $statusClass = 'textBlue';
                                break;
                            case 'Agendado':
                                $statusClass = 'textYellow';
                                break;
                            case 'Concluído':
                                $statusClass = 'textGreen';
                                break;

                            case 'Cancelado':
                                $statusClass = 'textRed';
                        }
                ?>

                        <article class="box_item">

                            <div class='card'>

                                <form method="POST" action="<?= BASE_URL ?>index.php?url=listarAgenda/cancelarAgenda">
                                    <input type="hidden" name="id_agendamento" value="<?= $agendamento['id_agendamento'] ?>">
                                    <button type="submit" class="btn-cancelar" onclick="return confirm('Cancelar este agendamento?')">
                                        &times;
                                    </button>
                                </form>
                            </div>

                            <p><strong>Veículo:</strong> <?= $agendamento['nome_modelo'] ?></p>
                            <p><strong>Funcionário:</strong> <?= $agendamento['nome_funcionario'] ?></p>
                            <p><strong>Data Agenda: </strong><?= date('d/m/Y H:i', strtotime($agendamento['data_agendamento'])) ?></p>
                            <p class="status <?= $statusClass ?>">STATUS: <span><?= $agendamento['status_agendamento'] ?></span></p>



                        </article>





                <?php
                    }
                } else {
                    echo "<p>Nenhum agendamento encontrado!</p>";
                }
                ?>

            </div>

            <a href="<?php echo BASE_URL ?>index.php?url=home" class="btnApp btnVoltar">VOLTAR</a>

        </section>

    </main>
</body>

</html>