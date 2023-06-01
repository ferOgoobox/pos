<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'codigo', 
                                    'nombre', 
                                    'precio_venta', 
                                    'precio_compra', 
                                    'existencia', 
                                    'stock_minimo',
                                    'inventariable',
                                    'id_unidad',
                                    'id_categoria',
                                    'activo'
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

    public function actualizaStock($id_producto, $cantidad, $operador = '+'){
        $this->set('existencia', "existencia $operador $cantidad", FALSE);
        $this->where('id', $id_producto);
        $this->update();
    }

    public function totalProductos(){
        return $this->where('activo', 1)->countAllResults(); //num_rows
    }

    public function stockMinimo(){
        $filters = "activo = 1 AND stock_minimo >= existencia AND inventariable = 1";
        return $this->where($filters)->countAllResults(); //num_rows
    }

    public function getProductoMinimo(){
        $filters = "activo = 1 AND stock_minimo >= existencia AND inventariable = 1";
        return $this->where($filters)->findAll(); //num_rows
    }
}
