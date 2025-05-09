<!DOCTYPE html>
<html lang="pt-br">

<?php require_once ('template/head.php') ?>

<body>
    <main>

        <section class="agendamento container">

            <h2 class="titulo">
                FAÇA SEU
                <span>AGENDAMENTO</span>
            </h2>

            <form method="" action="#" class="form_box container">

                <div class="input_group">

                    <!-- Veículo -->
                    <label for="dropVeiculo">veículo:</label>
                    <select name="dropVeiculo" id="dropVeiculo">
                        <option value="">-- Selecione --</option>
                    </select>

                    <!-- Data -->
                    <label for="txtData">Data:</label>
                    <input name="txtData" id="txtData" type="date">

                    <!-- Hora -->
                    <label for="txtHora">Hora:</label>
                    <input name="txtHora" id="txtHora" type="time">


                    <!-- Funcionário -->
                    <label for="dropFuncionario">Funcionário:</label>
                    <select name="dropFuncionario" id="dropFuncionario">
                        <option value="">-- Selecione --</option>
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