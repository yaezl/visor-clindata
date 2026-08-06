<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CondicionIva
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|Empleador[] $empleadors
 * @property Collection|Persona[] $personas
 * @property Collection|Personal[] $personals
 *
 * @package App\Models
 */
class CondicionIva extends Model
{
	protected $table = 'condicion_iva';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function empleadors()
	{
		return $this->hasMany(Empleador::class, 'condicion_iva');
	}

	public function personas()
	{
		return $this->hasMany(Persona::class, 'condicion_iva');
	}

	public function personals()
	{
		return $this->hasMany(Personal::class, 'idCondicionIva');
	}
}
