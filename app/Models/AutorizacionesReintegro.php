<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesReintegro
 * 
 * @property int $id
 * @property int|null $autorizacion_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string|null $observaciones
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property AutorizacionesAutorizacion|null $autorizaciones_autorizacion
 * @property Collection|Estudio[] $estudios
 * @property Collection|AutorizacionesReintegroMedicamento[] $autorizaciones_reintegro_medicamentos
 *
 * @package App\Models
 */
class AutorizacionesReintegro extends Model
{
	protected $table = 'autorizaciones_reintegro';

	protected $casts = [
		'autorizacion_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'autorizacion_id',
		'created_by',
		'modified_by',
		'observaciones',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}

	public function estudios()
	{
		return $this->belongsToMany(Estudio::class, 'autorizaciones_reintegro_estudios', 'reintegro_id')
					->withPivot('id', 'created_by', 'modified_by', 'precio', 'borrado_logico')
					->withTimestamps();
	}

	public function autorizaciones_reintegro_medicamentos()
	{
		return $this->hasMany(AutorizacionesReintegroMedicamento::class, 'reintegro_id');
	}
}
