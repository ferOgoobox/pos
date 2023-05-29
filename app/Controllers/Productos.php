<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;


class Productos extends BaseController {

    protected $productos;
    protected $unidades;
    protected $categorias;
    protected $reglas;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->unidades = new UnidadesModel();
        $this->categorias = new CategoriasModel();
        helper(['form']);

        $this->reglas = [
            'codigo' => [
                'rules' => 'required|is_unique[productos.codigo]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'is_unique' => 'El campo {field} debe ser unico.'
                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],
            'id_unidad' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],
            'id_categoria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],
            'precio_venta' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],
            'precio_compra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],
            'stock_minimo' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],

        ];
    }

    public function index($activo = '1')
    {
        $productos = $this->productos->where('activo', $activo)->findAll();

        $data = [
            'titulo' => 'Productos',
            'datos' => $productos
        ];
        
       echo view('header');
       echo view('productos/productos', $data);
       echo view('footer');
    }

    public function eliminados($activo = '0')
    {
        $productos = $this->productos->where('activo', $activo)->findAll();

        $data = [
            'titulo' => 'Productos eliminadas',
            'datos' => $productos
        ];
        
       echo view('header');
       echo view('productos/eliminados', $data);
       echo view('footer');

    }


    public function nuevo()
    {
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();

        $data = [
            'titulo' => 'Agregar producto',
            'unidades' => $unidades,
            'categorias' => $categorias,
        ];

        echo view('header');
        echo view('productos/nuevo', $data);
        echo view('footer');
    }


    public function insertar()
    {
        if ($this->request->is('post') && !$this->validate($this->reglas)) {
            $unidades = $this->unidades->where('activo', 1)->findAll();
            $categorias = $this->categorias->where('activo', 1)->findAll();
    
            $data = [
                'titulo' => 'Agregar producto',
                'unidades' => $unidades,
                'categorias' => $categorias,
                'validation' => $this->validator
            ];

            echo view('header');
            echo view('productos/nuevo', $data);
            echo view('footer');
        }else{

            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria'),
            ];
         
            $this->productos->save($data);
    
            return redirect()->to(base_url().'/productos');
        }
    }


    public function editar($id, $valid=null)
    {
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $producto = $this->productos->where('id', $id)->first();

        if ($valid != null) {
            $data = [
                'titulo' => 'Editar producto',
                'unidades' => $unidades,
                'categorias' => $categorias,
                'producto' => $producto,
                'validation' => $valid
            ];
        }else{
            $data = [
                'titulo' => 'Editar producto',
                'unidades' => $unidades,
                'categorias' => $categorias,
                'producto' => $producto
            ];
        }
        
       echo view('header');
       echo view('productos/editar', $data);
       echo view('footer');

    }

    public function actualizar()
    {
        $this->reglas['codigo']['rules'] = 'required';
        if ($this->request->is('post') && $this->validate($this->reglas)){
            $id = $this->request->getPost('id');
    
            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad' => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria'),
            ];
         
            $this->productos->update($id, $data);
    
            return redirect()->to(base_url().'/productos');
        }else{
            return $this->editar($this->request->getPost('id'), $this->validator);

        }

    }

    public function eliminar($id)
    {
        $this->productos->update($id, ['activo' => 0]);

        return redirect()->to(base_url().'/productos');

    }

    public function reingresar($id)
    {
        $this->productos->update($id, ['activo' => 1]);

        return redirect()->to(base_url().'/productos');

    }

    public function buscarPorCodigo($codigo)
    {
        $this->productos->select('*');
        $this->productos->where('codigo', $codigo);
        $this->productos->where('activo', 1);

        $datos = $this->productos->get()->getRow();

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';

        if($datos){
            $res['datos'] = $datos;
            $res['existe'] = true;
        }else{
            $res['error'] = 'No existe el producto';
            $res['existe'] = false;
        }

        echo json_encode($res);
    }


}