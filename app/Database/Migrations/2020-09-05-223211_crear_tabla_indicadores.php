<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaIndicadores extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'nombre'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
			],
			'unidad_medida' => [
					'type'           => 'VARCHAR',
					'constraint'     => '10',
					'null'           => true,
			],
	]);
	$this->forge->addKey('id', true);
	$this->forge->createTable('indicadores');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('indicadores');
	}
}
