<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipoprestacion
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * 
 * @property Collection|Prestacion[] $prestacions
 * @property Collection|Tipobono[] $tipobonos
 *
 * @package App\Models
 */
class Tipoprestacion extends Model
{
	protected $table = 'tipoprestacion';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function prestacions()
	{
		return $this->hasMany(Prestacion::class);
	}

	public function tipobonos()
	{
		return $this->belongsToMany(Tipobono::class)
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'eliminadopor_id', 'creado_en', 'modificado_en', 'borrado_en');
	}
}
