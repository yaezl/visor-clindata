<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CausaExternaHc
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $codigo
 * 
 * @property Collection|Consultadetalle[] $consultadetalles
 *
 * @package App\Models
 */
class CausaExternaHc extends Model
{
	protected $table = 'causa_externa_hc';
	public $timestamps = false;

	protected $casts = [
		'codigo' => 'int'
	];

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function consultadetalles()
	{
		return $this->hasMany(Consultadetalle::class, 'causa_externa_id');
	}
}
