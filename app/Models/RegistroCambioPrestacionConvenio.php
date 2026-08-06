<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegistroCambioPrestacionConvenio
 * 
 * @property int $id
 * @property int|null $prestacion_id
 * @property int|null $convenio_id
 * @property Carbon $created_at
 * @property int $createdBy
 * 
 * @property Prestacion|null $prestacion
 * @property Usuario $usuario
 * @property Convenio|null $convenio
 *
 * @package App\Models
 */
class RegistroCambioPrestacionConvenio extends Model
{
	protected $table = 'registro_cambio_prestacion_convenio';
	public $timestamps = false;

	protected $casts = [
		'prestacion_id' => 'int',
		'convenio_id' => 'int',
		'createdBy' => 'int'
	];

	protected $fillable = [
		'prestacion_id',
		'convenio_id',
		'createdBy'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'createdBy');
	}

	public function convenio()
	{
		return $this->belongsTo(Convenio::class);
	}
}
