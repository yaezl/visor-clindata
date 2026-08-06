<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkEnvioaalmacen
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property string|null $observaciones
 * 
 * @property Documento $documento
 *
 * @package App\Models
 */
class StkEnvioaalmacen extends Model
{
	protected $table = 'stk_envioaalmacen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'observaciones'
	];

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}
}
