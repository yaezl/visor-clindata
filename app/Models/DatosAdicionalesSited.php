<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatosAdicionalesSited
 * 
 * @property int $id
 * @property string $codigoUbicacion
 * @property string $direccion1
 * @property string $direccion2
 * @property string $email
 * @property string $celular
 * @property Carbon $createdAt
 * 
 * @property Collection|Sited[] $siteds
 *
 * @package App\Models
 */
class DatosAdicionalesSited extends Model
{
	protected $table = 'DatosAdicionalesSiteds';
	public $timestamps = false;

	protected $casts = [
		'createdAt' => 'datetime'
	];

	protected $fillable = [
		'codigoUbicacion',
		'direccion1',
		'direccion2',
		'email',
		'celular',
		'createdAt'
	];

	public function siteds()
	{
		return $this->hasMany(Sited::class, 'datosAdicionalesId');
	}
}
