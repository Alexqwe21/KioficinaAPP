<!DOCTYPE html>
<html lang="pt-br">

<?php require_once('template/head.php') ?>

<body>
    <main>

        <section class="agendamento container">

            <h2 class="titulo">
                DEIXE SEU
                <span>DEPOIMENTO</span>
            </h2>

            <form method="POST" action="<?= BASE_URL ?>index.php?url=depoimentos/enviarDepoimento" class="form_box container">

                <div class="input_group">
                    <label>NOTA:</label>
                    <div class="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <label for="descricao_depoimento">SEU DEPOIMENTO:</label>
                    <textarea name="descricao_depoimento" id="descricao_depoimento" required></textarea>
                    <!-- Input escondido para armazenar a nota do depoimento -->
                    <input type="hidden" name="nota_depoimento" id="nota_depoimento" value="">
                </div>

                <button type="submit" class="btnApp">ENVIAR DEPOIMENTO</button>
            </form>

            <a href="<?php echo BASE_URL ?>index.php?url=home" class="btnApp btnVoltar">VOLTAR</a>

        </section>

    </main>

    <script src="<?php echo BASE_URL ?>assets/js/script.js"></script>
</body>

</html>