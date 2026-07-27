<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkRecepcionalmacen
 * 
 * @property int $id
 * @property int|null $programa_id
 * @property Carbon $fecha
 * @property string|null $remito
 * 
 * @property FarPrograma|null $far_programa
 * @property Documento $documento
 *
 * @package App\Models
 */
class StkRecepcionalmacen extends Model
{
	protected $table = 'stk_recepcionalmacen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'programa_id' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'programa_id',
		'fecha',
		'remito'
	];

	public function far_programa()
	{
		return $this->belongsTo(FarPrograma::class, 'programa_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}
}
