<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionSalaAlmacenesASolicitar
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $almacen_id
 * @property int $sala_id
 * @property int $prioridad
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property Almacen $almacen
 * @property InternacionSala $internacion_sala
 *
 * @package App\Models
 */
class InternacionSalaAlmacenesASolicitar extends Model
{
	protected $table = 'internacion_sala_almacenes_a_solicitar';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'almacen_id' => 'int',
		'sala_id' => 'int',
		'prioridad' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'almacen_id',
		'sala_id',
		'prioridad',
		'creado_en',
		'modificado_en',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function internacion_sala()
	{
		return $this->belongsTo(InternacionSala::class, 'sala_id');
	}
}
