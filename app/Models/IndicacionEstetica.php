<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IndicacionEstetica
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Collection|IndicacionEsteticaDetalle[] $indicacion_estetica_detalles
 *
 * @package App\Models
 */
class IndicacionEstetica extends Model
{
	protected $table = 'indicacion_estetica';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function indicacion_estetica_detalles()
	{
		return $this->hasMany(IndicacionEsteticaDetalle::class, 'indicacionEstetica_id');
	}
}
