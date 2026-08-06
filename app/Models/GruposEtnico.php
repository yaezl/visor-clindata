<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GruposEtnico
 * 
 * @property int $id
 * @property string $nombre
 * @property bool $borradoLogico
 * 
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class GruposEtnico extends Model
{
	protected $table = 'gruposEtnicos';
	public $timestamps = false;

	protected $casts = [
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'borradoLogico'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class, 'grupoEtnico_id');
	}
}
