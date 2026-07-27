<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Odontotipodibujo
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * 
 * @property Collection|Capituloodontodibujo[] $capituloodontodibujos
 * @property Collection|Capituloodontoestudiodibujo[] $capituloodontoestudiodibujos
 *
 * @package App\Models
 */
class Odontotipodibujo extends Model
{
	protected $table = 'odontotipodibujo';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function capituloodontodibujos()
	{
		return $this->hasMany(Capituloodontodibujo::class, 'tipo_id');
	}

	public function capituloodontoestudiodibujos()
	{
		return $this->hasMany(Capituloodontoestudiodibujo::class, 'tipo_id');
	}
}
