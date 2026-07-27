<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoDocumento
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * @property int $codigo_efactura
 * @property int $digitos
 * 
 * @property Collection|Persona[] $personas
 * @property Collection|PersonaCambioDato[] $persona_cambio_datos
 *
 * @package App\Models
 */
class TipoDocumento extends Model
{
	use SoftDeletes;
	protected $table = 'tipo_documento';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'codigo_efactura' => 'int',
		'digitos' => 'int'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo',
		'codigo_efactura',
		'digitos'
	];

	public function personas()
	{
		return $this->hasMany(Persona::class);
	}

	public function persona_cambio_datos()
	{
		return $this->hasMany(PersonaCambioDato::class);
	}
}
