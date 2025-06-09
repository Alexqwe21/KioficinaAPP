<?php

class PerfilController extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['token'])) {
            header("Location: " . BASE_URL . "index.php?url=login");
            exit;
        }

        $dadosToken = TokenHelper::validar($_SESSION['token']);

        if (!$dadosToken) {
            session_destroy();
            unset($_SESSION['token']);
            header("Location: " . BASE_URL . "index.php?url=login");
            exit;
        }

        // ATUALIZAÇÃO DO CLIENTE
        //ANALISAR SE O FORM FOI ENVIADO
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $endereco = $_POST['txtLogradouro'] . ", " . $_POST['txtNumero'];

            $dadosAtualizados = [
                'nome_cliente' => $_POST['txtNome'],
                'email_cliente' => $_POST['txtEmail'],
                'telefone_cliente' => $_POST['txtTelefone'],
                'endereco_cliente' => $endereco,
                'bairro_cliente' => $_POST['txtBairro'],
                'cidade_cliente' => $_POST['txtCidade'],
                'id_uf' => $_POST['id_uf']
            ];

            if (!empty($_POST['senha'])) {
                $dadosAtualizados['senha_cliente'] = $_POST['senha'];
            }

            // Junta os dados do formulário
            $dadosEnviar = $dadosAtualizados;
            // Se houver imagem, adiciona como CURLFile
            if (isset($_FILES['foto_cliente']) && $_FILES['foto_cliente']['error'] === UPLOAD_ERR_OK) {
                $dadosEnviar['foto_cliente'] = new CURLFile(
                    $_FILES['foto_cliente']['tmp_name'],
                    $_FILES['foto_cliente']['type'],
                    $_FILES['foto_cliente']['name']
                );
            }

            $urlAtualizar = BASE_API . "atualizarCliente/" . $dadosToken['id'];
            $chAtualizar = curl_init($urlAtualizar);
            curl_setopt($chAtualizar, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chAtualizar, CURLOPT_POST, true);
            curl_setopt($chAtualizar, CURLOPT_POSTFIELDS, $dadosEnviar); // <- Agora com suporte a imagem

            curl_setopt($chAtualizar, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $_SESSION['token']
                // Sem Content-Type manual
            ]);

            $resposta = curl_exec($chAtualizar);
            $statusCodeAtualizar = curl_getinfo($chAtualizar, CURLINFO_HTTP_CODE);
            curl_close($chAtualizar);




            if ($statusCodeAtualizar === 200) {
                $_SESSION['msg_sucesso'] = "Perfil atualizado com sucesso";
                header("Location: " . BASE_URL . "index.php?url=perfil");
                exit;
            } else {
                $_SESSION['msg_erro'] = "Erro ao atualizar o perfil. Código: $statusCodeAtualizar";
            }
        }
        //Buscar os clientes na API
        $url = BASE_API . "cliente/" . $dadosToken['id'];

        //Reconhecimento da chave (Inicializa uma sessão cURL)
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $_SESSION['token']
        ]);


        //Recebe os dados dessa solicitação
        $response = curl_exec($ch);
        //Obtém o código HTTP da resposta (200, 400, 401)
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //Encerra a sessão da chave
        curl_close($ch);

        if ($statusCode != 200) {
            echo "Erro ao buscar a ordens de serviço na API. \n
            Código HTTP: $statusCode";
            exit;
        }

        //Separa os dados em 'campos'
        $cliente = json_decode($response, true);

        //Fazer a busca da lista de estados
        $urlEstados = BASE_API . "listarEstados";
        $chEstado = curl_init($urlEstados);
        curl_setopt($chEstado, CURLOPT_RETURNTRANSFER, true);
        $responseEstado = curl_exec($chEstado);
        //Obtém o código HTTP da resposta (200, 400, 401)
        $statusCodeEstados = curl_getinfo($chEstado, CURLINFO_HTTP_CODE);
        curl_close($chEstado);
        $estados = ($statusCodeEstados == 200) ? json_decode($responseEstado, true) : [];

        $dados = array();
        $dados['titulo'] = 'KiOficina - Perfil';
        $dados['cliente'] = $cliente;
        $dados['estados'] = $estados;

        $this->carregarViews('perfil', $dados);
    }
}
