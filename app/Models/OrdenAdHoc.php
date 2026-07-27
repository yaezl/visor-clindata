<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdenAdHoc
 * 
 * @property int $id
 * @property string $texto
 * 
 * @property Indicacion $indicacion
 *
 * @package App\Models
 */
class OrdenAdHoc extends Model
{
	protected $table = 'orden_ad_hoc';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'texto'
	];

	public function indicacion()
	{
		return $this->belongsTo(Indicacion::class, 'id');
	}
}
