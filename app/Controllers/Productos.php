<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;
use Barcode;
use FPDF;

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

            $id = $this->productos->insertID();

            if ($imagefile = $this->request->getFiles()) {
                $contador =  1;
                foreach ($imagefile['img_producto'] as $img) {

                    $ruta = "images/productos/".$id;

                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }

                    if ($img->isValid() && ! $img->hasMoved()) {
                        
                        $img->move('./images/productos/',$id.'/foto_'.$contador.'.jpg');
                        $contador++;

                        // $newName = $img->getRandomName();
                        // $img->move(WRITEPATH . 'uploads', $newName);
                    }
                }
            }

            // $validation = $this->validate([
            //     'img_producto' => 'uploaded[img_producto]|max_size[img_producto,4026]|mime_in[img_producto,image/jpg,image/jpeg]',
            // ]);

            // if($validation){
            //     $ruta_logo = "images/productos".$id.".jpg";
            //     if(file_exists($ruta_logo)){
            //         unlink($ruta_logo);
            //     }
            //     $img = $this->request->getFile('img_producto');
            //     $img->move('./images/productos', $id.".jpg");
            // }else{
            //     echo 'ERROR al cargar la imagen';
            //     exit;
            // }

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


    public function autocompleteData()
    {
        $returnData = array();

        $valor = $this->request->getGet('term');

        $productos = $this->productos->like('codigo', $valor)->where('activo', 1)->findAll();

        if (!empty($productos)) {
            foreach ($productos as $row) {
                $data['id'] = $row['id'];
                $data['value'] = $row['codigo'];
                $data['label'] = $row['codigo'].' - '.$row['nombre'];
                array_push($returnData, $data);
            }
        }

        echo json_encode($returnData);

    }

    public function generaBarras()
    {
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle(utf8_decode("Códigos de barras"));

        $productos = $this->productos->where('activo', 1)->findAll();

        foreach ($productos as $producto) {
            $codigo = $producto['codigo'];
            $generaBarcode = new \barcode_genera();
            $generaBarcode->barcode("images/barcode/".$codigo . ".png", $codigo, 20, "horizontal", "code128", true);
            $pdf->Image("images/barcode/".$codigo . ".png");
            unlink("images/barcode/".$codigo . ".png");
        }
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('Codigos.pdf', 'I');
    }

    public function muestraCodigos()
    {
        echo view('header');
        echo view('productos/codigos_pdf');
        echo view('footer');
    }

    public function mostrarMinimos()
    {
        echo view('header');
        echo view('productos/ver_minimos');
        echo view('footer');
    }

    public function generaMinimosPdf()
    {
        $pdf = new FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle(utf8_decode("Producto con stock mínimo"));
        $pdf->SetFont("Arial", "B", 10);

        $pdf->Image("images/logotipo.png", 10, 5, 20);

        $pdf->Cell(0, 5, utf8_decode("Reporte de producto con stock mínimo"), 0, 1, 'C');
       
        $pdf->Ln(20);
        
        $pdf->Cell(40, 5, utf8_decode("Código"), 1, 0, 'C'); //190
        $pdf->Cell(90, 5, utf8_decode("Nombre"), 1, 0, 'C');
        $pdf->Cell(30, 5, utf8_decode("Existencias"), 1, 0, 'C');
        $pdf->Cell(30, 5, utf8_decode("Stock mínimo"), 1, 1, 'C');

        $datosProductos = $this->productos->getProductoMinimo();
        $pdf->SetFont("Arial", "", 10);
        foreach ($datosProductos as $producto) {
            $pdf->Cell(40, 5, $producto['codigo'], 1, 0, 'C'); //190
            $pdf->Cell(90, 5, utf8_decode($producto['nombre']), 1, 0, 'C');
            $pdf->Cell(30, 5, $producto['existencia'], 1, 0, 'C');
            $pdf->Cell(30, 5, $producto['stock_minimo'], 1, 1, 'C');
        }
        
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('Codigos.pdf', 'I');
    }

}