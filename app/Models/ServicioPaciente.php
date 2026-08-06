<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServicioPaciente
 * 
 * @property int $id
 * @property int $estudio_id
 * @property int $consulta_id
 * @property int $created_by
 * @property int $modified_by
 * @property string|null $observacion
 * @property float $valor
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Estudio $estudio
 * @property Consultum $consultum
 *
 * @package App\Models
 */
class ServicioPaciente extends Model
{
	protected $table = 'servicio_paciente';

	protected $casts = [
		'estudio_id' => 'int',
		'consulta_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'valor' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'estudio_id',
		'consulta_id',
		'created_by',
		'modified_by',
		'observacion',
		'valor',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}
}
