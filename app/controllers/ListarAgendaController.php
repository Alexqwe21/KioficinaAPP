<?php

class ListarAgendaController extends Controller
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

        //Buscar as ordens executado na API
        $url = BASE_API . "agendamentosPorCliente/" . $dadosToken['id'];

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
        $agendamentos = json_decode($response, true);


        $agenda = [];

        if (is_array($agendamentos) && isset($agendamentos[0]) && is_array($agendamentos[0])) {
            $agenda = $agendamentos;
        }

        $dados = array();
        $dados['titulo'] = 'KiOficina - ListarAgenda';

        $dados['agendamentos'] = $agenda;

        $this->carregarViews('listarAgenda', $dados);
    }

    public function cancelarAgenda()
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


        if (!isset($_POST['id_agendamento'])) {
            $_SESSION['msg_erro'] = 'ID do agendamento não fornecido';

            header("Location: " . BASE_URL . "index.php?url=listarAgenda");
            exit;
        }
        $idAgendamento = $_POST['id_agendamento'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, BASE_API ."cancelarAgendamento/$idAgendamento");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,[
            "Authorization: Bearer " . $_SESSION['token'],
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $resposta = json_decode($response, true);

        if($statusCode ===200){
            $_SESSION['msg_sucesso'] = $resposta['mensagem'] ?? 'Agendamento cancelado com sucesso!';
        }else{
            $_SESSION['msg_erro'] = $resposta['erro']
                                            ?? 'Erro ao cancelar o agendamento';

        }
        
        header("Location: " . BASE_URL . "index.php?url=listarAgenda");
        exit;

    }
}
