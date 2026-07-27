<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionOrdenUrgente
 * 
 * @property int $id
 * 
 * @property InternacionOrden $internacion_orden
 *
 * @package App\Models
 */
class InternacionOrdenUrgente extends Model
{
	protected $table = 'internacion_orden_urgente';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'id');
	}
}
