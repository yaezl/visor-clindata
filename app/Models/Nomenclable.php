<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Nomenclable
 * 
 * @property int $id
 * @property string $dtype
 * 
 * @property Arancel|null $arancel
 * @property ArancelCategorium|null $arancel_categorium
 * @property Categorium|null $categorium
 * @property Collection|Institucion[] $institucions
 * @property Prestacion|null $prestacion
 * @property PrestacionArancel|null $prestacion_arancel
 * @property Collection|Regla[] $reglas
 *
 * @package App\Models
 */
class Nomenclable extends Model
{
	protected $table = 'nomenclable';
	public $timestamps = false;

	protected $fillable = [
		'dtype'
	];

	public function arancel()
	{
		return $this->hasOne(Arancel::class, 'id');
	}

	public function arancel_categorium()
	{
		return $this->hasOne(ArancelCategorium::class, 'id');
	}

	public function categorium()
	{
		return $this->hasOne(Categorium::class, 'id');
	}

	public function institucions()
	{
		return $this->belongsToMany(Institucion::class, 'nomenclable_institucion')
					->withPivot('id');
	}

	public function prestacion()
	{
		return $this->hasOne(Prestacion::class, 'id');
	}

	public function prestacion_arancel()
	{
		return $this->hasOne(PrestacionArancel::class, 'id');
	}

	public function reglas()
	{
		return $this->hasMany(Regla::class);
	}
}
