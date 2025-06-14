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
        $cliente = $this->ClienteModel->getById($id);

        if (!$cliente) {
            show_404();
        }

        $this->load->view('clientes/edit', ['cliente' => $cliente]);
    }

    public function update($id)
    {
        $this->load->helper(['form', 'url']);
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');

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

}
