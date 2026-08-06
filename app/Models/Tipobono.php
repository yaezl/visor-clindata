<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipobono
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * @property string|null $letra
 * @property string|null $color
 * 
 * @property Collection|Bono[] $bonos
 * @property Collection|Facturacriterio[] $facturacriterios
 * @property Collection|Prefacturacriterio[] $prefacturacriterios
 * @property Collection|Tipoprestacion[] $tipoprestacions
 *
 * @package App\Models
 */
class Tipobono extends Model
{
	protected $table = 'tipobono';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo',
		'letra',
		'color'
	];

	public function bonos()
	{
		return $this->hasMany(Bono::class);
	}

	public function facturacriterios()
	{
		return $this->hasMany(Facturacriterio::class);
	}

	public function prefacturacriterios()
	{
		return $this->hasMany(Prefacturacriterio::class);
	}

	public function tipoprestacions()
	{
		return $this->belongsToMany(Tipoprestacion::class)
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'eliminadopor_id', 'creado_en', 'modificado_en', 'borrado_en');
	}
}
