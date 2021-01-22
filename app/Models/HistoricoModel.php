<?php namespace App\Models;

use CodeIgniter\Model;

class HistoricoModel extends Model
{
    protected $table      = 'historicos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fecha', 'valor', 'indicador'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    public function getRegistrosUf() {
        $registrosUf = array();
		$historicos = $this->findAll();

		foreach ($historicos as $row) {
			array_push($registrosUf, $row);
        }
        
        return ($registrosUf);
    }

    public function actualizarHistoricos($indicadores) {
        $db = db_connect();
        $db->query('TRUNCATE `tareasolutoria`.`historicos`');

        for ($i=0; $i < count($indicadores->serie) ; $i++) { 
            $data = [
				'fecha' => $indicadores->serie[$i]->fecha,
				'valor' => $indicadores->serie[$i]->valor,
				'indicador' => 1
            ];
            $algo = $this->save($data);
        }
        
    }

    public function actualizarRegistro($idRegistro, $valorRegistro, $fechaRegistro ) {
        try {
            $data = [
                'id'    => $idRegistro,
				'fecha' => $fechaRegistro,
				'valor' => $valorRegistro,
				'indicador' => 1
            ];
            $this->save($data);
        } catch (\Throwable $th) {
            return (string)$th;
        }   
    }

    public function eliminarRegistro($idRegistro) {
        try {
            $this->delete($idRegistro);
        } catch (\Throwable $th) {
            return (string)$th;
        }
        
    }

    public function ingresarRegistro($valorRegistro, $fechaRegistro) {
        try {
            try {
                $data = [
                    'fecha' => $fechaRegistro,
                    'valor' => $valorRegistro,
                    'indicador' => 1
                ];
                $this->save($data);
            } catch (\Throwable $th) {
                return (string)$th;
            }
        } catch (\Throwable $th) {
            return (string)$th;
        }
    }
}