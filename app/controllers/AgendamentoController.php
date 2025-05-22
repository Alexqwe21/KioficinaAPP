<?php

class AgendamentoController extends Controller
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

        // LISTAR  OS VEICULOS DO CLIENTE

        //Buscar o cliente na API
        $urlVeiculos = BASE_API . "veiculo/" . $dadosToken['id'];

        //Reconhecimento da chave (Inicializa uma sessão cURL)
        $chVeiculos = curl_init($urlVeiculos);
        curl_setopt($chVeiculos, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($chVeiculos, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $_SESSION['token']
        ]);


        //Recebe os dados dessa solicitação
        $responseVeiculos = curl_exec($chVeiculos);
        //Obtém o código HTTP da resposta (200, 400, 401)
        $statusCodeVeiculos = curl_getinfo($chVeiculos, CURLINFO_HTTP_CODE);

        //Encerra a sessão da chave
        curl_close($chVeiculos);

        if ($statusCodeVeiculos != 200) {
            echo "Erro ao buscar os veiculos na API. \n
            Código HTTP: $statusCodeVeiculos";
            exit;
        }

        $veiculos = json_decode($responseVeiculos, true);


        // LISTAR OS FUNCIONARIOS



        //Buscar o cliente na API
        $urlFuncionarios = BASE_API . "listarFunc";

        //Reconhecimento da chave (Inicializa uma sessão cURL)
        $chFuncionarios = curl_init($urlFuncionarios);
        curl_setopt($chFuncionarios, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($chFuncionarios, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $_SESSION['token']
        ]);


        //Recebe os dados dessa solicitação
        $responseFuncionarios = curl_exec($chFuncionarios);
        //Obtém o código HTTP da resposta (200, 400, 401)
        $statusCodeFuncionarios = curl_getinfo($chFuncionarios, CURLINFO_HTTP_CODE);

        //Encerra a sessão da chave
        curl_close($chFuncionarios);

        if ($statusCodeFuncionarios != 200) {
            echo "Erro ao buscar os veiculos na API. \n
            Código HTTP: $statusCodeFuncionarios";
            exit;
        }

        $funcionarios = json_decode($responseFuncionarios, true);
// <a href=""></a>

        // LISTAR OS FUNCIONARIOS


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data_agenda'];
            $hora = $_POST['id_hora'];
            $dataAgendamento = $data . ' ' . $hora;

            $dataAgendamento = [
                'id_veiculo' => $_POST['id_veiculo'],
                'id_funcionario' => $_POST['id_funcionario'],
                'data_agendamento' => $dataAgendamento
            ];


            $urlAgendar = BASE_API . "criarAgendamento";
            $chAgenda = curl_init($urlAgendar);
            curl_setopt($chAgenda, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chAgenda, CURLOPT_POSTFIELDS, json_encode($dataAgendamento));
            curl_setopt($chAgenda, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $_SESSION['token'],
                'Content-Type: application/json'
            ]);

            $resposta = curl_exec($chAgenda);
            $statusCodeAgenda = curl_getinfo($chAgenda, CURLINFO_HTTP_CODE);
            curl_close($chAgenda);

            if ($statusCodeAgenda === 200) {
                $_SESSION['msg_sucesso'] = 'Agendamento realizado com sucesso !';
                header("Location: " . BASE_URL . "index.php?url=agendamento");
                exit;
            }else{
                $_SESSION['msg_erro'] = "Erro ao agendar  . Codigo: ! $statusCodeAgenda" ;
            }
        }

        $dados = array();
        $dados['titulo'] = 'KiOficina - Agendamento';
        $dados['veiculos'] = $veiculos;
        $dados['funcionarios'] = $funcionarios;
        $this->carregarViews('agendamento', $dados);
    }
}
