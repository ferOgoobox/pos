<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;

class Cajas extends BaseController {

    protected $cajas;
    protected $reglas;

    public function __construct()
    {
        $this->cajas = new CajasModel();

        helper(['form']);

        $this->reglas = [ 
            'folio' => [
                'rules' => 'required|is_unique[cajas.folio]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.'
                ] 
            ],
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
        $cajas = $this->cajas->where('activo', $activo)->findAll();

        $data = [
            'titulo' => 'Cajas',
            'datos' => $cajas
        ];
        
       echo view('header');
       echo view('cajas/cajas', $data);
       echo view('footer');
    }

    public function eliminados($activo = '0')
    {
        $cajas = $this->cajas->where('activo', $activo)->findAll();

        $data = [
            'titulo' => 'Cajas eliminadas',
            'datos' => $cajas
        ];
        
       echo view('header');
       echo view('cajas/eliminados', $data);
       echo view('footer');

    }


    public function nuevo()
    {
        $data = ['titulo' => 'Agregar caja'];

        echo view('header');
        echo view('cajas/nuevo', $data);
        echo view('footer');
    }


    public function insertar()
    {
        if ($this->request->is('post') && !$this->validate($this->reglas)) {
            $data = [
                'titulo' => 'Agregar caja', 
                'validation' => $this->validator
            ];

            echo view('header');
            echo view('cajas/nuevo', $data);
            echo view('footer');
        }else{
            $folio = $this->request->getPost('folio');
            $nombre = $this->request->getPost('nombre');
    
            $data = [
                'folio' => $folio,
                'nombre' => $nombre
            ];
    
            $this->cajas->save($data);
    
            return redirect()->to(base_url().'/cajas');
        }
    }


    public function editar($id, $valid=null)
    {
        $caja = $this->cajas->where('id', $id)->first();

        if ($valid != null) {
            $data = [
                'titulo' => 'Editar cajas',
                'datos' => $caja,
                'validation' => $valid
            ];
        }else{
            $data = [
                'titulo' => 'Editar cajas',
                'datos' => $caja
            ];
        }
        
       echo view('header');
       echo view('cajas/editar', $data);
       echo view('footer');

    }

    public function actualizar()
    {
        $this->reglas['folio']['rules'] = 'required';
        if ($this->request->is('post') && $this->validate($this->reglas)) {
            $id = $this->request->getPost('id');
    
            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'folio' => $this->request->getPost('folio')
            ];

            $this->cajas->update($id, $data);
    
            return redirect()->to(base_url().'/cajas');
        }else{
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }

    public function eliminar($id)
    {
        $this->cajas->update($id, ['activo' => 0]);

        return redirect()->to(base_url().'/cajas');

    }

    public function reingresar($id)
    {
        $this->cajas->update($id, ['activo' => 1]);

        return redirect()->to(base_url().'/cajas');

    }

}