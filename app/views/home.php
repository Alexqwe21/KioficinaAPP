<!DOCTYPE html>
<html lang="pt-br">

<?php require_once ('template/head.php') ?>

<body>
    <main>

        <section class="home container">

            <div class="logo">
                <img src="<?php echo BASE_URL ?>assets/img/logoKiOficina.svg" alt="Logotipo KiOficina">
            </div>

            <h2 class="titulo">
                BEM VINDO À
                <span>KI-OFICINA</span>
            </h2>

            <h2 class="username">
                OLÁ, <?php echo htmlspecialchars($nome_cliente, ENT_QUOTES, "UTF-8") ?>!
            </h2>

            <ul class="menuButtons">
                <li><a class="btnApp" href="<?php echo BASE_URL ?>index.php?url=agendamento">AGENDAMENTO</a></li>
                <li><a class="btnApp" href="<?php echo BASE_URL ?>index.php?url=listarAgenda">LISTAR AGENDA</a></li>
                <li><a class="btnApp" href="<?php echo BASE_URL ?>index.php?url=listarServicos">LISTAR SERVIÇOS</a></li>
                <li><a class="btnApp" href="<?php echo BASE_URL ?>index.php?url=depoimentos">DEPOIMENTOS</a></li>
                <li><a class="btnApp" href="<?php echo BASE_URL ?>index.php?url=perfil">PERFIL</a></li>
                <li><a class="btnApp bgRed" href="<?php echo BASE_URL ?>index.php?url=login">SAIR</a></li>
            </ul>

        </section>

    </main>
</body>

</html>