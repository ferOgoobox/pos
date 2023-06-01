<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ventas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'folio', 
        'total', 
        'id_usuario',
        'id_caja',
        'id_cliente',
        'forma_pago',
        'activo',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function insertaVenta($id_venta, $total, $id_usuario, $id_caja, $id_cliente, $forma_pago){
        $data = [
            'folio' => $id_venta,
            'total' => $total,
            'id_caja' => $id_caja,
            'id_usuario' => $id_usuario,
            'id_cliente' => $id_cliente,
            'forma_pago' => $forma_pago,
        ];

        $this->insert($data);

        return $this->insertID();
    }


    public function obtener($activo = 1){

        $this->select('ventas.*, u.usuario AS cajero, c.nombre AS cliente');
        $this->join('usuarios AS u', 'ventas.id_usuario = u.id'); //INNER JOIN
        $this->join('clientes AS c', 'ventas.id_cliente = c.id'); //INNER JOIN
        $this->where('ventas.activo', $activo);
        $this->orderBy('ventas.fecha_alta', 'DESC');

        $datos = $this->findAll();
        // print_r($this->getlastQuery());

        return $datos;
    }

    public function totalDia($fecha){
        $this->select("sum(total) AS total");
        $filters = "activo = 1 AND DATE(fecha_alta) = '$fecha'";
        return $this->where($filters)->first(); //num_rows

    }
    
}
  