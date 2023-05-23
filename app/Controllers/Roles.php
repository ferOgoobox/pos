<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;

class Roles extends BaseController {

    protected $roles;
    protected $reglas;

    public function __construct()
    {
        $this->roles = new RolesModel();

        helper(['form']);

        $this->reglas = [ 
            'nombre' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ] 
            ],
        ];
    }

    public function index($activo = '1')
    {
        $roles = $this->roles->where('activo', $activo)->findAll();

        $data = [
            'titulo' => 'Roles',
            'datos' => $roles
        ];
        
       echo view('header');
       echo view('roles/roles', $data);
       echo view('footer');
    }

    public function eliminados($activo = '0')
    {
        $roles = $this->roles->where('activo', $activo)->findAll();

        $data = [
            'titulo' => 'Roles eliminadas',
            'datos' => $roles
        ];
        
       echo view('header');
       echo view('roles/eliminados', $data);
       echo view('footer');

    }


    public function nuevo()
    {
        $data = ['titulo' => 'Agregar rol'];

        echo view('header');
        echo view('roles/nuevo', $data);
        echo view('footer');
    }


    public function insertar()
    {
        if ($this->request->is('post') && !$this->validate($this->reglas)) {
            $data = [
                'titulo' => 'Agregar rol', 
                'validation' => $this->validator
            ];

            echo view('header');
            echo view('roles/nuevo', $data);
            echo view('footer');
        }else{
            $nombre = $this->request->getPost('nombre');
    
            $data = [
                'nombre' => $nombre
            ];
    
            $this->roles->save($data);
    
            return redirect()->to(base_url().'/roles');
        }
    }


    public function editar($id, $valid=null)
    {
        $rol = $this->roles->where('id', $id)->first();

        if ($valid != null) {
            $data = [
                'titulo' => 'Editar rol',
                'datos' => $rol,
                'validation' => $valid
            ];
        }else{
            $data = [
                'titulo' => 'Editar rol',
                'datos' => $rol
            ];
        }
        
       echo view('header');
       echo view('roles/editar', $data);
       echo view('footer');

    }

    public function actualizar()
    {
        if ($this->request->is('post') && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
    
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'folio' => $this->request->getPost('folio')
            ];

            $this->roles->update($id, $data);
    
            return redirect()->to(base_url().'/roles');
        }else{
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id)
    {
        $this->roles->update($id, ['activo' => 0]);

        return redirect()->to(base_url().'/roles');

    }

    public function reingresar($id)
    {
        $this->roles->update($id, ['activo' => 1]);

        return redirect()->to(base_url().'/roles');

    }

}