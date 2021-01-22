<?php namespace App\Database\Seeds;

class uf_seeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $this->db->query("INSERT INTO indicadores (nombre, unidad_medida) VALUES('Unidad de fomento (UF)', 'Pesos')");
        }
}