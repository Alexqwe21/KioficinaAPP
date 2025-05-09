<?php

class DepoimentosController extends Controller
{
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'KiOficina - Depoimento';

        $this->carregarViews('depoimentos', $dados);
    }
}
