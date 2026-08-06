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
 * Class Departamento
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
 * 
 * @property Collection|Especialidad[] $especialidads
 * @property Collection|Estudioexterno[] $estudioexternos
 *
 * @package App\Models
 */
class Departamento extends Model
{
	use SoftDeletes;
	protected $table = 'departamento';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo'
	];

	public function especialidads()
	{
		return $this->hasMany(Especialidad::class);
	}

	public function estudioexternos()
	{
		return $this->hasMany(Estudioexterno::class);
	}
}
