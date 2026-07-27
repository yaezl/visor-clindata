<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TarjetaPortal
 * 
 * @property int $id
 * @property int $obra_social_id
 * @property int|null $logo_id
 * @property string $tipo_tarjeta
 * 
 * @property Archivo|null $archivo
 * @property ObraSocial $obra_social
 *
 * @package App\Models
 */
class TarjetaPortal extends Model
{
	protected $table = 'tarjeta_portal';
	public $timestamps = false;

	protected $casts = [
		'obra_social_id' => 'int',
		'logo_id' => 'int'
	];

	protected $fillable = [
		'obra_social_id',
		'logo_id',
		'tipo_tarjeta'
	];

	public function archivo()
	{
		return $this->belongsTo(Archivo::class, 'logo_id');
	}

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class);
	}
}
