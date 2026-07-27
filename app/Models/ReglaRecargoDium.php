<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaRecargoDium
 * 
 * @property int $id
 * @property int $recargo_id
 * @property int $dia
 * @property Carbon $hora_inicio
 * @property bool $borrado_logico
 * @property Carbon $hora_fin
 * 
 * @property Recargo $recargo
 *
 * @package App\Models
 */
class ReglaRecargoDium extends Model
{
	protected $table = 'regla_recargo_dia';
	public $timestamps = false;

	protected $casts = [
		'recargo_id' => 'int',
		'dia' => 'int',
		'hora_inicio' => 'datetime',
		'borrado_logico' => 'bool',
		'hora_fin' => 'datetime'
	];

	protected $fillable = [
		'recargo_id',
		'dia',
		'hora_inicio',
		'borrado_logico',
		'hora_fin'
	];

	public function recargo()
	{
		return $this->belongsTo(Recargo::class);
	}
}
