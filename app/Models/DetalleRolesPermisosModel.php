<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleRolesPermisosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'detalle_roles_permisos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_rol', 'id_permiso'];

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

    public function verificaPermisos($id_rol, $permiso)
    {
        $tieneAcceso = false;
        $this->select('*');
        $this->join('permisos', 'detalle_roles_permisos.id_permiso = permisos.id');
        $existe = $this->where(['id_rol' => $id_rol, 'permisos.nombre' => $permiso])->first();

        // echo $this->getLastQuery();

        if($existe != null) {
            $tieneAcceso = true;
        }
        return $tieneAcceso;
    }

}
