<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\TemporalCompraModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;
use App\Models\CajasModel;

class Ventas extends BaseController {

    protected $ventas, $temporal_compra, $detalle_venta, $productos, $configuracion, $cajas, $session;

    public function __construct()
    {
        $this->ventas = new VentasModel();
        $this->detalle_venta = new DetalleVentaModel();
        $this->productos = new ProductosModel();
        $this->configuracion = new ConfiguracionModel();
        $this->cajas = new CajasModel();
        $this->session = session();
    }

    public function index()
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }
        
        $ventas = $this->ventas->obtener();

        $data = [
            'titulo' => 'Ventas',
            'datos' => $ventas
        ];
        
       echo view('header');
       echo view('ventas/ventas', $data);
       echo view('footer');
    }

    public function eliminados($activo = '0')
    {
        $ventas = $this->ventas->obtener(0);

        $data = [
            'titulo' => 'Ventas eliminadas',
            'datos' => $ventas
        ];
        
       echo view('header');
       echo view('ventas/eliminados', $data);
       echo view('footer');

    }


    public function venta()
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }

        echo view('header');
        echo view('ventas/caja');
        echo view('footer');
    }


    public function guarda()
    {
        $id_venta = $this->request->getPost('id_venta');
        $forma_pago = $this->request->getPost('forma_pago');
        $id_cliente = $this->request->getPost('id_cliente');

        $total =  preg_replace('/[\$,]/','',$this->request->getPost('total'));

        $caja = $this->cajas->where('id', $this->session->id_caja)->first();
        $folio = $caja['folio'];
        
        $resultadoId = $this->ventas->insertaVenta($folio, $total, $this->session->id_usuario, $this->session->id_caja, $id_cliente, $forma_pago);

        $this->temporal_compra = new TemporalCompraModel();

        if ($resultadoId) {
            $folio++;
            $this->cajas->update($this->session->id_caja, ['folio' =>   $folio ]);

            $resultadoCompra = $this->temporal_compra->porCompra($id_venta);

            foreach ($resultadoCompra as $row) {
                $this->detalle_venta->save([
                    "id_venta" => $resultadoId, 
                    "id_producto" => $row['id_producto'], 
                    "nombre" => $row['nombre'], 
                    "cantidad" => $row['cantidad'], 
                    "precio" => $row['precio'], 
                ]);
                $this->productos->actualizaStock($row['id_producto'], $row['cantidad'], '-');
            }
            $this->temporal_compra->eliminarCompra($id_venta);
        }
        return redirect()->to(base_url()."/ventas/muestraTicket/".$resultadoId);
    }


    public function muestraTicket($id_venta)
    {
        $data['id_venta'] = $id_venta;
        echo view('header');
        echo view('ventas/ver_ticket', $data);
        echo view('footer');
    }

    public function generaTicket($id_venta)
    {
        $datosVenta = $this->ventas->where('id', $id_venta)->first();
        $detalleVenta = $this->detalle_venta->select('*')->where('id_venta', $id_venta)->findAll();
        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
        $leyendaTicket = $this->configuracion->select('valor')->where('nombre', 'tienda_leyenda')->get()->getRow()->valor;

        $pdf = new \FPDF('P','mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Venta");
        $pdf->SetFont("Arial", 'B', 10);
        $pdf->Cell(70, 5, $nombreTienda, 0, 1, 'C');

        $pdf->SetFont("Arial", 'B', 9);

        // $pdf->Image("images/logotipo.png", 185, 10, 20, 20, 'PNG');

        $pdf->SetFont("Arial", '', 9);
        $pdf->Cell(70, 5, $direccionTienda, 0, 1, 'C');
        
        $pdf->SetFont("Arial", 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha y hora: '), 0, 0, 'L');
        $pdf->SetFont("Arial", '', 9);
        $pdf->Cell(50, 5, $datosVenta['fecha_alta'], 0, 1, 'L');
        
        $pdf->SetFont("Arial", 'B', 9);
        $pdf->Cell(15, 5, utf8_decode('Ticket: '), 0, 0, 'L');
        $pdf->SetFont("Arial", '', 9);
        $pdf->Cell(50, 5, $datosVenta['folio'], 0, 1, 'L');
        
        $pdf->Ln();

        $pdf->SetFont("Arial", 'B', 7);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->Cell(7, 5, 'Cant.', 0, 0, 'L');
        $pdf->Cell(35, 5, 'Nombre', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Importe', 0, 1, 'L');

        $pdf->SetFont("Arial", '', 7);
        $contador = 1;

        foreach ($detalleVenta as $row) {
            $pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
            $pdf->Cell(35, 5, $row['nombre'], 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $importe = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(15, 5, '$'.$importe,  0, 1, 'R');
            $contador++;
        }

        $pdf->Ln();

        $pdf->SetFont("Arial", 'B', 8);
        $pdf->Cell(70, 5, 'Total: $'. number_format($datosVenta['total'], 2, '.', ','), 0, 1, 'R');

        $pdf->Ln();
        $pdf->SetFont("Arial", 'B', 8);
        $pdf->MultiCell(70, 4, $leyendaTicket, 0, 'C', 0);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ticket.pdf", "I");
    }

    public function eliminar($id_venta)
    {
        $productos = $this->detalle_venta->where('id_venta',  $id_venta)->findAll();

        foreach ($productos as $row) {
           $this->productos->actualizaStock($row['id_producto'], $row['cantidad']);
        }

        $data = [
            'activo' => 0,
        ];

        $this->ventas->update($id_venta, $data);

        return redirect()->to(base_url().'/ventas');
    }
    

}