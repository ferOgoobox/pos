<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;

class Configuracion extends BaseController {

    protected $configuracion;
    protected $reglas;

    public function __construct()
    {
        $this->configuracion = new ConfiguracionModel();

        helper(['form', 'upload']);

        $this->reglas = [ 
            'tienda_nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ] 
            ],
            'tienda_rfc' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ] 
            ],
            'tienda_telefono' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ] 
            ],
            'tienda_email' =>  [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'valid_email' => 'El campo {field} tiene un formato inválido.'

                ] 
            ],
            'tienda_direccion' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ] 
            ],
            'tienda_leyenda' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ] 
            ],
        ];
    }

    public function index($valid = null)
    {
        $nombre = $this->configuracion->where('nombre', 'tienda_nombre')->first();
        $rfc = $this->configuracion->where('nombre', 'tienda_rfc')->first();
        $telefono = $this->configuracion->where('nombre', 'tienda_telefono')->first();
        $email = $this->configuracion->where('nombre', 'tienda_email')->first();
        $direccion = $this->configuracion->where('nombre', 'tienda_direccion')->first();
        $leyenda = $this->configuracion->where('nombre', 'tienda_leyenda')->first();

        $data = [
            'titulo' => 'Configuración',
            'nombre' => $nombre,
            'rfc' => $rfc,
            'telefono' => $telefono,
            'email' => $email,
            'direccion' => $direccion,
            'leyenda' => $leyenda,
            'validation' => $valid
        ];
        
       echo view('header');
       echo view('configuracion/configuracion', $data);
       echo view('footer');
    }

    public function actualizar()
    {
        if ($this->request->is('post') && $this->validate($this->reglas)) {
    
            $this->configuracion->whereIn('nombre', ['tienda_nombre'])->set(['valor' => $this->request->getPost('tienda_nombre')])->update();
            $this->configuracion->whereIn('nombre', ['tienda_rfc'])->set(['valor' => $this->request->getPost('tienda_rfc')])->update();
            $this->configuracion->whereIn('nombre', ['tienda_telefono'])->set(['valor' => $this->request->getPost('tienda_telefono')])->update();
            $this->configuracion->whereIn('nombre', ['tienda_email'])->set(['valor' => $this->request->getPost('tienda_email')])->update();
            $this->configuracion->whereIn('nombre', ['tienda_direccion'])->set(['valor' => $this->request->getPost('tienda_direccion')])->update();
            $this->configuracion->whereIn('nombre', ['tienda_leyenda'])->set(['valor' => $this->request->getPost('tienda_leyenda')])->update();
    
            $validation = $this->validate([
                'tienda_logo' => 'uploaded[tienda_logo]|max_size[tienda_logo,4026]|mime_in[tienda_logo,image/png]',
            ]);

            if($validation){
                $ruta_logo = 'images/logotipo.png';
                if(file_exists($ruta_logo)){
                    unlink($ruta_logo);
                }
                $img = $this->request->getFile('tienda_logo');
                $img->move('./images', 'logotipo.png');
            }else{
                echo 'ERROR al cargar la imagen';
                exit;
            }

            return redirect()->to(base_url().'/configuracion');
        }else{
            return $this->index($this->validator);
        }
    }

}