<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoIncapacidad
 * 
 * @property int $id
 * @property string $nombre
 * @property bool $borrado_logico
 * 
 * @property Collection|IncapacidadHc[] $incapacidad_hcs
 *
 * @package App\Models
 */
class TipoIncapacidad extends Model
{
	protected $table = 'tipo_incapacidad';
	public $timestamps = false;

	protected $casts = [
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'borrado_logico'
	];

	public function incapacidad_hcs()
	{
		return $this->hasMany(IncapacidadHc::class);
	}
}
