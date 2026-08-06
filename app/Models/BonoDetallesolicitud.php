<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonoDetallesolicitud
 * 
 * @property int $detallesolicitud_id
 * @property int $bono_id
 * 
 * @property Bono $bono
 * @property FarDetalleSolicitud $far_detalle_solicitud
 *
 * @package App\Models
 */
class BonoDetallesolicitud extends Model
{
	protected $table = 'bono_detallesolicitud';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'detallesolicitud_id' => 'int',
		'bono_id' => 'int'
	];

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function far_detalle_solicitud()
	{
		return $this->belongsTo(FarDetalleSolicitud::class, 'detallesolicitud_id');
	}
}
