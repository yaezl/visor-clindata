<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NomenclableInstitucion
 * 
 * @property int $id
 * @property int|null $nomenclable_id
 * @property int|null $institucion_id
 * 
 * @property Nomenclable|null $nomenclable
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class NomenclableInstitucion extends Model
{
	protected $table = 'nomenclable_institucion';
	public $timestamps = false;

	protected $casts = [
		'nomenclable_id' => 'int',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'nomenclable_id',
		'institucion_id'
	];

	public function nomenclable()
	{
		return $this->belongsTo(Nomenclable::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
