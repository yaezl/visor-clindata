<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionPerfilEstudiosLaboratorio
 * 
 * @property int $internacion_perfil_estudios_labo_id
 * @property int $estudiosLaboratorio_id
 * 
 * @property InternacionPerfilEstudiosLabo $internacion_perfil_estudios_labo
 * @property AdminEstudiosLaboratorio $admin_estudios_laboratorio
 *
 * @package App\Models
 */
class InternacionPerfilEstudiosLaboratorio extends Model
{
	protected $table = 'internacion_perfil_estudios_laboratorio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'internacion_perfil_estudios_labo_id' => 'int',
		'estudiosLaboratorio_id' => 'int'
	];

	public function internacion_perfil_estudios_labo()
	{
		return $this->belongsTo(InternacionPerfilEstudiosLabo::class);
	}

	public function admin_estudios_laboratorio()
	{
		return $this->belongsTo(AdminEstudiosLaboratorio::class, 'estudiosLaboratorio_id');
	}
}
