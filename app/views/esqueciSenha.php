<!DOCTYPE html>
<html lang="pt-br">

<?php require_once('template/head.php') ?>

<body>
    <main>

        <section class="login container">


            <h2 class="titulo">Recuperar Senha</h2>

            <form method="POST" action="<?php echo BASE_API; ?>recuperarSenha" class="form_box container">

                <div class="input_group">

                    <!-- email -->
                    <label for="txtEmail" class="lblLogin">E-mail Cadastrado:</label>
                    <input name="email_cliente" id="email_cliente" type="text">




                </div>


                <button type="submit" class="btnApp">ENVIAR LINK</button>

            </form>

           <a href="<?php echo BASE_URL ?>index.php?url=login" class="btnApp btnVoltar">VOLTAR</a>
        </section>

    </main>
</body>

</html>