<?php

namespace App\Models;

use CodeIgniter\Model;

class TemporalCompraModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'temporal_compra';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'folio', 
        'id_producto', 
        'codigo', 
        'nombre', 
        'cantidad', 
        'precio', 
        'subtotal',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
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


    public function porIdProductoCompra($id_producto, $folio){
        $this->select('*');
        $this->where('folio', $folio);
        $this->where('id_producto', $id_producto);
        $datos = $this->get()->getRow();
        return $datos;
    }

    public function porCompra($folio){
        $this->select('*');
        $this->where('folio', $folio);
        $datos = $this->findAll();
        return $datos;
    }
    public function actualizarProductoCompra($id_producto, $folio, $cantidad, $subtotal){
        $this->set('cantidad', $cantidad);
        $this->set('subtotal', $subtotal);
        $this->where('id_producto', $id_producto);
        $this->where('folio', $folio);
        $this->update();
    }

    public function eliminarProductoCompra($id_producto, $folio){
        $this->where('folio', $folio);
        $this->where('id_producto', $id_producto);
        $this->delete();
    }

    public function eliminarCompra($folio){
        $this->where('folio', $folio);
        $this->delete();
    }
}
