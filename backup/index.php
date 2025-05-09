<!DOCTYPE html>
<html lang="pt-br">

<?php
require_once('app/views/template/head.php')
?>

<body>
    <main>

        <section class="login container">
            <div class="logo">
                <img src="img/logoKiOficina.svg" alt="Logotipo KiOficina">
            </div>

            <h2 class="titulo">Login</h2>

            <form method="" action="home.php" class="form_box container">

                <div class="input_group">

                    <!-- email -->
                    <label for="txtEmail" class="lblLogin">E-mail:</label>
                    <input name="txtEmail" id="txtEmail" type="text" placeholder="exemplo@exemplo.com">

                    <!-- senha -->
                    <label for="txtSenha" class="lblLogin">Senha:</label>
                    <input name="txtSenha" id="txtSenha" type="password" placeholder="*******">
                    
                    <a class="esqueciSenha" href="esqueciSenha.html">Esqueci senha</a>
                    
                </div>


                <button type="submit" class="btnApp">ENTRAR</button>
            </form>

        </section>

    </main>
</body>

</html>