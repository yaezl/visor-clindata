<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkEnvioapersona
 * 
 * @property int $id
 * @property int|null $turno_id
 * @property Carbon $fecha
 * @property string|null $observaciones
 * 
 * @property TurnoProgramado|null $turno_programado
 * @property Documento $documento
 *
 * @package App\Models
 */
class StkEnvioapersona extends Model
{
	protected $table = 'stk_envioapersona';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'turno_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'turno_id',
		'fecha',
		'observaciones'
	];

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'turno_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}
}
