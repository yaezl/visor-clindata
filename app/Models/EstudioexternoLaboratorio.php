<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstudioexternoLaboratorio
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property int|null $persona_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property Carbon|null $fecha
 * @property string|null $institucion
 * @property string|null $resultado
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property AdminEstudiosLaboratorio|null $admin_estudios_laboratorio
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class EstudioexternoLaboratorio extends Model
{
	protected $table = 'estudioexterno_laboratorio';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'persona_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'fecha' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'estudio_id',
		'persona_id',
		'created_by',
		'modified_by',
		'modified_at',
		'fecha',
		'institucion',
		'resultado',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function admin_estudios_laboratorio()
	{
		return $this->belongsTo(AdminEstudiosLaboratorio::class, 'estudio_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
