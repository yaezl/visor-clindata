<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Documentofacturacion
 * 
 * @property int $id
 * @property Carbon $fecha
 * @property int|null $centrodecostoDocumento_id
 * @property Carbon $periodoDesde
 * @property Carbon $periodoHasta
 * 
 * @property Documento $documento
 * @property Centrodecosto|null $centrodecosto
 * @property CancelacionDocumento|null $cancelacion_documento
 *
 * @package App\Models
 */
class Documentofacturacion extends Model
{
	protected $table = 'documentofacturacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'fecha' => 'datetime',
		'centrodecostoDocumento_id' => 'int',
		'periodoDesde' => 'datetime',
		'periodoHasta' => 'datetime'
	];

	protected $fillable = [
		'fecha',
		'centrodecostoDocumento_id',
		'periodoDesde',
		'periodoHasta'
	];

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function centrodecosto()
	{
		return $this->belongsTo(Centrodecosto::class, 'centrodecostoDocumento_id');
	}

	public function cancelacion_documento()
	{
		return $this->hasOne(CancelacionDocumento::class, 'documentoFacturacion_id');
	}
}
