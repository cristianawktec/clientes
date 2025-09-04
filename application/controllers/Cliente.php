<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('ClienteModel');
    }

    public function index()
    {    
        $data['clientes'] = $this->ClienteModel->getAll();
        $this->load->view('clientes/index', $data);
    }

    public function create()
    {
        $this->load->view('clientes/create');
    }

public function store()
{
    $this->load->helper(['form', 'url']);
    $this->load->library('form_validation');

    // Mensagens personalizadas
    $this->form_validation->set_message([
        'required' => 'O campo {field} é obrigatório.',
        'valid_email' => 'Informe um endereço de e-mail válido.',
        'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
        'numeric' => 'O campo {field} deve conter apenas números.'
    ]);

    $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('telefone', 'Telefone', 'required|regex_match[/^[0-9]{10,11}$/]');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('clientes/create');
        return;
    }

    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    $imageName = '';

    if ($this->upload->do_upload('imagem')) {
        $uploadData = $this->upload->data();
        $imageName = $uploadData['file_name'];
    }

    $this->ClienteModel->save([
        'nome'     => $this->input->post('nome'),
        'email'    => $this->input->post('email'),
        'telefone' => $this->input->post('telefone'),
        'imagem'   => $imageName
    ]);

    redirect('cliente');
}


    public function edit($id)
    {
        $this->load->library('Curl');
        
        $cliente = $this->ClienteModel->getById($id);
        $endereco = $this->CepModel->get_byId($id);

        if (!$cliente) {
            show_404();
        }

        $this->load->view('clientes/edit', [
            'cliente' => $cliente,
            'endereco' => $endereco
        ]);
    }

    public function update($id)
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');
        $this->load->library('Curl');

        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');

        $this->EnderecoModel->updateOrInsert($id, [
            'cep' => $this->input->post('cep'),
            'logradouro' => $this->input->post('logradouro'),
            'numero' => $this->input->post('numero'),
            'complemento' => $this->input->post('complemento'),
            'bairro' => $this->input->post('bairro'),
            'cidade' => $this->input->post('cidade'),
            'uf' => $this->input->post('uf')
        ]);

        if ($this->form_validation->run() == FALSE) {
            $cliente = $this->ClienteModel->getById($id);
            $this->load->view('clientes/edit', ['cliente' => $cliente]);
            return;
        }

        $data = [
            'nome'     => $this->input->post('nome'),
            'email'    => $this->input->post('email'),
            'telefone' => $this->input->post('telefone'),
        ];

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('imagem')) {
            $uploadData = $this->upload->data();
            $data['imagem'] = $uploadData['file_name'];
        }

        $this->ClienteModel->update($id, $data);
        redirect('cliente');
    }

    public function delete($id)
    {
        $this->load->model('ClienteModel');
        $this->ClienteModel->delete($id);
        redirect('cliente');
    }

    /**
     * Recebe o CEP via post e retorna os dados
     * consultados via JSON
     */
    public function consulta(){

        $cep = $this->input->post('cep');

        //pesquisa no banco se existe o cep
        $consulta = $this->cep_model->get_byId($cep);
        //$msg = "Pesquisa Realizada direto do Banco!";
        if($this->db->affected_rows() > 0 ){
             foreach($consulta->result() as $endereco){
                $dados['bairro'] = $endereco->bairro;
                $dados['cep'] = $endereco->cep;
                $dados['complemento'] = $endereco->complemento;
                $dados['gia'] = $endereco->gia;
                $dados['ibge'] = $endereco->ibge;
                $dados['localidade'] = $endereco->localidade;
                $dados['logradouro'] = $endereco->logradouro;
                $dados['uf'] = $endereco->uf;
                $dados['unidade'] = $endereco->unidade;
                $dados['msg'] = "local";
              echo json_encode($endereco);
            }

        }else{
            //carregando a biblioteca do curl
            $this->load->library('curl');    

            $consulta =  $this->curl->consulta($cep);
            $decode = json_decode($consulta);
            $cep = str_replace("-", "", $decode->cep);

            $dados['cep'] = $cep;
            $dados['logradouro'] = $decode->logradouro;
            $dados['complemento'] = $decode->complemento;
            $dados['bairro'] = $decode->bairro;
            $dados['localidade'] = $decode->localidade;
            $dados['uf'] = $decode->uf;
            //$dados['unidade'] = $decode->unidade;
            $dados['ibge'] = $decode->ibge;
            $dados['gia'] = $decode->gia;
            $dados['msg'] = "viacep";
            //$dados = json_decode($novo);
            //echo"<pre>";print_r($dados);echo"</pre>";exit;
            //inserindo novo registro no banco 
            if($this->cep_model->inserir($dados)){
                //pesquisa no banco se existe o cep
                $dados = $this->cep_model->get_byId($cep);
                //echo"<pre>";print_r($dados);echo"</pre>";exit;
                if($this->db->affected_rows() > 0 ){
                    foreach($dados->result() as $endereco){
                        echo json_encode($endereco);
                    }
                }
                //echo"<br>Dados Inseridos com Sucesso!";
            }else{
                echo "Erro ao Inserir os Dados!";
            }
            //carrega os dados na view
            echo $this->curl->consulta($cep);
        }
  
    }    

}
