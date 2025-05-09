<?php

class EsqueciSenhaController extends Controller
{
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'KiOficina - EsqueciSenha';

        $this->carregarViews('esqueciSenha', $dados);
    }

    
}
