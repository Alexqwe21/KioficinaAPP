<!DOCTYPE html>
<html lang="pt-br">

<?php require_once('template/head.php') ?>

<body>
    <main>

        <section class="agendamento container">

            <h2 class="titulo">
                MEU PERFIL
            </h2>


            <?php if (!empty($_SESSION['msg_sucesso'])): ?>
                <div class="alert sucesso"><?= $_SESSION['msg_sucesso'] ?></div>
                <?php unset($_SESSION['msg_sucesso']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['msg_erro'])): ?>
                <div class="alert erro"><?= $_SESSION['msg_erro'] ?></div>
                <?php unset($_SESSION['msg_erro']); ?>
            <?php endif; ?>


            <?php
            $imagemPadrao = BASE_FOTO . 'sem-foto-cliente.png';

            // Verifica se existe uma imagem cadastrada para o cliente
            $fotoCliente = !empty($cliente['foto_cliente']) ?
                BASE_FOTO . $cliente['foto_cliente'] :
                $imagemPadrao;

            ?>



            <form method="POST" action="" class="form_box container" enctype="multipart/form-data" id="formFoto">


                <div class="imgPerfil" id="imgPerfilContainer">
                    <div class="imgContainer">
                        <img id="imagemPerfil" src="<?= $fotoCliente ?>">
                    </div>
                    <!-- Botão de alteração de imagem -->
                    <div>
                        <input type="file" name="foto_cliente" id="foto_cliente" style="display:none;" accept="image/*" capture="camera">
                        <input type="hidden" class="btn-upload" value="+" onclick="document.getElementById('foto_cliente').click()">
                    </div>
                </div>




                <div class="input_group">

                    <!-- Nome -->
                    <label for="txtNome">Nome:</label>
                    <input name="txtNome" type="text" value="<?= htmlspecialchars($cliente['nome_cliente'], ENT_QUOTES, 'UTF-8') ?>">

                    <!-- Email -->
                    <label for="txtEmail">E-mail:</label>
                    <input name="txtEmail" type="text" value="<?= htmlspecialchars($cliente['email_cliente'], ENT_QUOTES, 'UTF-8') ?>">

                    <!-- Telefone -->
                    <label for="txtTelefone">Telefone:</label>
                    <input name="txtTelefone" id="txtTelefone" type="text" value="<?= htmlspecialchars($cliente['telefone_cliente'], ENT_QUOTES, 'UTF-8') ?>">

                    <!-- CEP -->
                    <label for="txtCEP">CEP:</label>
                    <input name="txtCEP" type="text">
                    <button type="button" id="txtCEP" class="btnApp bgBlue btnCEP">BUSCAR CEP</button>

                    <?php
                    // Endereço e Número
                    $partes = explode(',', $cliente['endereco_cliente']);
                    ?>

                    <!-- Logradouro -->
                    <label for="txtLogradouro">Logradouro:</label>
                    <input name="txtLogradouro" id="txtLogradouro" type="text" value="<?= htmlspecialchars($partes[0], ENT_QUOTES, 'UTF-8') ?>" readonly>

                    <!-- Cidade -->


                    <label for="txtCidade">Cidade:</label>
                    <input name="txtCidade" id="txtCidade" type="text" readonly value="<?= htmlspecialchars($cliente['cidade_cliente'], ENT_QUOTES, 'UTF-8') ?>">

                    <label for="txtCidade">Bairro:</label>
                    <input name="txtBairro" id="txtCidade" type="text" readonly value="<?= htmlspecialchars($cliente['bairro_cliente'], ENT_QUOTES, 'UTF-8') ?>">

                    <div class="group">
                        <!-- Estado -->
                        <div class="col50">
                            <label for="id_uf">Estado:</label>
                            <select name="id_uf" id="id_uf">
                                <option value="">-- Selecione um estado --</option>
                                <?php foreach ($estados as $estado) : ?>
                                    <option value="<?= $estado['id_uf'] ?>" <?= $cliente['id_uf'] == $estado['id_uf'] ? 'selected' : '' ?>>
                                        <?= $estado['sigla_uf'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <!-- Numero -->
                        <div class="col50">
                            <label for="txtNumero">Numero:</label>
                            <input name="txtNumero" id="txtNumero" type="text" value="<?= htmlspecialchars($partes[1], ENT_QUOTES, 'UTF-8') ?>">
                        </div>
                    </div>

                    <!-- Nova Senha -->
                    <label for="txtNovaSenha">NOVA SENHA:</label>
                    <input name="txtNovaSenha" id="txtNovaSenha" type="text">

                    <label for="txtConfirmSenha">CONFIRMAR SENHA:</label>
                    <input name="txtConfirmSenha" id="txtConfirmSenha" type="text">

                </div>

                <button type="submit" class="btnApp">SALVAR ALTERAÇÕES</button>
            </form>





            <a href="<?php echo BASE_URL ?>index.php?url=home" class="btnApp btnVoltar">VOLTAR</a>

        </section>

    </main>


    <script>
     const inputFoto = document.getElementById('foto_cliente');
            const imgPreview = document.getElementById('imagemPerfil');
            const imgPerfilContainer = document.getElementById('imgPerfilContainer');
 
            imgPerfilContainer.addEventListener('click', function() {
                inputFoto.click();
            })
 
            inputFoto.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
    </script>



</body>

</html>