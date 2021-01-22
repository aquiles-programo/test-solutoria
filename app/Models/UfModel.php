<?php namespace App\Models;

use CodeIgniter\Model;

class IndicadorModel extends Model
{
    protected $table      = 'indicadores';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'unidad_medida'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    public function getDatosUf() {
        return ($this->find(1));
    }
}