<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bonocriterio
 * 
 * @property int $id
 * @property int|null $bono_id
 * @property int|null $medico_id
 * @property int|null $especialidad_id
 * @property int|null $unidadNegocio_id
 * 
 * @property UnidadNegocio|null $unidad_negocio
 * @property Bono|null $bono
 * @property Personal|null $personal
 * @property Especialidad|null $especialidad
 *
 * @package App\Models
 */
class Bonocriterio extends Model
{
	protected $table = 'bonocriterio';
	public $timestamps = false;

	protected $casts = [
		'bono_id' => 'int',
		'medico_id' => 'int',
		'especialidad_id' => 'int',
		'unidadNegocio_id' => 'int'
	];

	protected $fillable = [
		'bono_id',
		'medico_id',
		'especialidad_id',
		'unidadNegocio_id'
	];

	public function unidad_negocio()
	{
		return $this->belongsTo(UnidadNegocio::class);
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'medico_id');
	}

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}
}
