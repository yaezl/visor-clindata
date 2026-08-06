<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaTipoContribuyente
 * 
 * @property int $id
 * @property int $created_by
 * @property int $persona_id
 * @property int $empleador_id
 * @property Carbon $created_at
 * 
 * @property Empleador $empleador
 * @property Usuario $usuario
 * @property Persona $persona
 *
 * @package App\Models
 */
class PersonaTipoContribuyente extends Model
{
	protected $table = 'persona_tipo_contribuyente';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'persona_id' => 'int',
		'empleador_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'persona_id',
		'empleador_id'
	];

	public function empleador()
	{
		return $this->belongsTo(Empleador::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
