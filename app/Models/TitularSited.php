<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TitularSited
 * 
 * @property int $id
 * @property string $apellidos
 * @property string $nombres
 * @property int $tipoDocumento
 * @property string $documento
 * @property string $codigoTipoDocumento
 * @property int $tipoAfiliacion
 * @property string $codigoTipoAfiliacion
 * @property string $numeroPlan
 * @property int $tipoPlanSalud
 * @property string $nombrePlanSalud
 * @property string $contratante
 * @property Carbon $createdAt
 * 
 * @property Collection|Sited[] $siteds
 *
 * @package App\Models
 */
class TitularSited extends Model
{
	protected $table = 'TitularSiteds';
	public $timestamps = false;

	protected $casts = [
		'tipoDocumento' => 'int',
		'tipoAfiliacion' => 'int',
		'tipoPlanSalud' => 'int',
		'createdAt' => 'datetime'
	];

	protected $fillable = [
		'apellidos',
		'nombres',
		'tipoDocumento',
		'documento',
		'codigoTipoDocumento',
		'tipoAfiliacion',
		'codigoTipoAfiliacion',
		'numeroPlan',
		'tipoPlanSalud',
		'nombrePlanSalud',
		'contratante',
		'createdAt'
	];

	public function siteds()
	{
		return $this->hasMany(Sited::class, 'titularId');
	}
}
