<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TratamientoImpositivo
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Usuario|null $usuario
 * @property Collection|ObraSocial[] $obra_socials
 *
 * @package App\Models
 */
class TratamientoImpositivo extends Model
{
	protected $table = 'tratamiento_impositivo';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'borrado_logico',
		'modified_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function obra_socials()
	{
		return $this->hasMany(ObraSocial::class);
	}
}
