<!DOCTYPE html>
<html lang="pt-br">

<?php require_once('template/head.php') ?>

<body>
    <main>

        <section class="agendamento container">

            <h2 class="titulo">
                FAÇA SEU
                <span>AGENDAMENTO</span>
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


            <form method="POST" action="#" class="form_box container">

                <div class="input_group">

                    <!-- Veículo -->
                    <label for="id_veiculo">veículo:</label>
                    <select name="id_veiculo" id="id_veiculo">
                        <option value="">--Selecione--</option>
                        <?php foreach ($veiculos as $veiculo): ?>

                            <option value="<?= $veiculo['id_veiculo'] ?>"><?= $veiculo['nome_modelo'] ?> - <?= $veiculo['cor_veiculo'] ?> - <?= $veiculo['ano_veiculo'] ?></option>
                        <?php endforeach; ?>
                    </select>


                    <!-- Data -->
                    <label for="data_agenda">Data:</label>
                    <input name="data_agenda" id="data_agenda" type="date" value="<?= date('Y-m-d') ?>">


                    <label for="id_hora">Hora:</label>
                    <select name="id_hora" id="id_hora" required>
                        <option value="">Selecione a hora</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                    </select>




                    <!-- Funcionário -->
                    <label for="id_funcionario">Funcionário:</label>
                    <select name="id_funcionario" id="id_funcionario">
                        <option value="">-- Selecione --</option>
                        <?php foreach ($funcionarios as $funcionario): ?>
                            <option value="<?= $funcionario['id_funcionario'] ?>"><?= $funcionario['nome_funcionario'] ?></option>

                        <?php endforeach; ?>
                    </select>

                </div>

                <button type="submit" class="btnApp">AGENDAR</button>
            </form>

            <ul class="menuButtons">
                <li>
                    <a href="<?php echo BASE_URL ?>index.php?url=home" class="btnApp btnVoltar">VOLTAR</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL ?>index.php?url=listarAgenda" class="btnApp bgGreen">LISTAR AGENDA</a>
                </li>
            </ul>

        </section>

    </main>
</body>

</html>