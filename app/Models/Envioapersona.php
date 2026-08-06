<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Envioapersona
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property int|null $turno_id
 * @property string|null $observaciones
 * @property bool $borrado_logico
 * @property int|null $aplicacionEnfermeria_id
 * 
 * @property InternacionHojaEnfermeriaMedicacion|null $internacion_hoja_enfermeria_medicacion
 * @property TurnoProgramado|null $turno_programado
 * @property Documento $documento
 * @property Collection|Bono[] $bonos
 *
 * @package App\Models
 */
class Envioapersona extends Model
{
	protected $table = 'envioapersona';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'fecha' => 'datetime',
		'turno_id' => 'int',
		'borrado_logico' => 'bool',
		'aplicacionEnfermeria_id' => 'int'
	];

	protected $fillable = [
		'fecha',
		'turno_id',
		'observaciones',
		'borrado_logico',
		'aplicacionEnfermeria_id'
	];

	public function internacion_hoja_enfermeria_medicacion()
	{
		return $this->belongsTo(InternacionHojaEnfermeriaMedicacion::class, 'aplicacionEnfermeria_id');
	}

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function bonos()
	{
		return $this->belongsToMany(Bono::class, 'envioapersona_bono', 'envio_id');
	}
}
