<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaRecargoOcasional
 * 
 * @property int $id
 * @property int $recargo_id
 * @property Carbon $fecha
 * @property bool $borrado_logico
 * 
 * @property Recargo $recargo
 *
 * @package App\Models
 */
class ReglaRecargoOcasional extends Model
{
	protected $table = 'regla_recargo_ocasional';
	public $timestamps = false;

	protected $casts = [
		'recargo_id' => 'int',
		'fecha' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'recargo_id',
		'fecha',
		'borrado_logico'
	];

	public function recargo()
	{
		return $this->belongsTo(Recargo::class);
	}
}
