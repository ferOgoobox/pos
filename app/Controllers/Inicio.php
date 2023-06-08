<?php

namespace App\Controllers;
use App\Models\ProductosModel;
use App\Models\VentasModel;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Inicio extends BaseController
{
    protected $productoModel, $ventasModel, $session;

    public function __construct()
    {
       $this->productoModel = new ProductosModel();
       $this->ventasModel = new VentasModel();
       $this->session = session();
    }

    public function index()
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }

        $total = $this->productoModel->totalProductos();
        $totalVentas = $this->ventasModel->totalDia(date('Y-m-d')); //2020-06-01
        $stockMinimo = $this->productoModel->stockMinimo();

        $mensaje = $this->session->getFlashdata('mensaje');

        $data = [
            'total' => $total,
            'totalVentas' => $totalVentas,
            'stockMinimo' => $stockMinimo,
            'mensaje' => $mensaje
        ];

        echo view('header');
        echo view('inicio', $data);
        echo view('footer');
    }

    

    public function excel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello Fernando !');
        $writer = new Xlsx($spreadsheet);
        $writer->save('prueba.xlsx');
    }

}
