<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use CodeIgniter\Controller;

class Cliente extends Controller
{
    public function index()
    {
        $model = new ClienteModel();
        $data['clientes'] = $model->findAll();

            file_put_contents(WRITEPATH . 'logs/teste.txt', 'Funcionando!');
    echo "Testado!";

        return view('clientes/index', $data);
    }

    public function create()
    {
        return view('clientes/create');
    }

    public function store()
    {
        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'telefone' => 'required',
            'imagem' => 'uploaded[imagem]|is_image[imagem]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('clientes/create', ['validation' => $validation]);
        }

        $img = $this->request->getFile('imagem');
        $nomeImg = $img->getRandomName();
        $img->move('uploads', $nomeImg);

        $model = new ClienteModel();
        $model->save([
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
            'imagem' => $nomeImg
        ]);

        return redirect()->to('/cliente');
    }


    public function edit($id)
    {
        $model = new ClienteModel();
        $data['cliente'] = $model->find($id);
        return view('clientes/edit', $data);
    }

    public function update($id)
    {
        $model = new ClienteModel();
        $data = $this->request->getPost();

        if ($this->request->getFile('imagem')->isValid()) {
            $img = $this->request->getFile('imagem');
            $nomeImg = $img->getRandomName();
            $img->move('uploads', $nomeImg);
            $data['imagem'] = $nomeImg;
        }

        $model->update($id, $data);
        return redirect()->to('/cliente');
    }

    public function delete($id)
    {
        $model = new ClienteModel();
        $model->delete($id);
        return redirect()->to('/cliente');
    }
}
