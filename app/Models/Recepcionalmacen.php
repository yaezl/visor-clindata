<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recepcionalmacen
 * 
 * @property int $id
 * @property int|null $procedencia_id
 * @property Carbon $fecha
 * @property string|null $remito
 * @property int|null $programa_id
 * 
 * @property Procedencium|null $procedencium
 * @property Documento $documento
 * @property FarPrograma|null $far_programa
 *
 * @package App\Models
 */
class Recepcionalmacen extends Model
{
	protected $table = 'recepcionalmacen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'procedencia_id' => 'int',
		'fecha' => 'datetime',
		'programa_id' => 'int'
	];

	protected $fillable = [
		'procedencia_id',
		'fecha',
		'remito',
		'programa_id'
	];

	public function procedencium()
	{
		return $this->belongsTo(Procedencium::class, 'procedencia_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function far_programa()
	{
		return $this->belongsTo(FarPrograma::class, 'programa_id');
	}
}
