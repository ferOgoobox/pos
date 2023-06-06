<?php

namespace App\Models;

use CodeIgniter\Model;

class ArqueoCajaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'arqueo_caja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_caja', 
        'id_usuario', 
        'fecha_inicio', 
        'fecha_fin', 
        'monto_inicial', 
        'monto_final', 
        'total_ventas',
        'estatus'
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

    public function getData($id_caja){
        $this->select('arqueo_caja.*, cajas.nombre');
        $this->join('cajas', 'cajas.id = arqueo_caja.id_caja');
        $this->where('arqueo_caja.id_caja', $id_caja);
        $this->orderBy('arqueo_caja.id', 'DESC');
        $datos = $this->findAll();
        return $datos;
    }
}
