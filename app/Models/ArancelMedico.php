<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArancelMedico
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $tipo_arancel_id
 * @property int|null $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property TipoArancelMedico|null $tipo_arancel_medico
 * @property Collection|ProfesionalPlanArancel[] $profesional_plan_arancels
 *
 * @package App\Models
 */
class ArancelMedico extends Model
{
	protected $table = 'arancel_medico';

	protected $casts = [
		'created_by' => 'int',
		'tipo_arancel_id' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'tipo_arancel_id',
		'modified_by',
		'nombre',
		'codigo',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function tipo_arancel_medico()
	{
		return $this->belongsTo(TipoArancelMedico::class, 'tipo_arancel_id');
	}

	public function profesional_plan_arancels()
	{
		return $this->hasMany(ProfesionalPlanArancel::class, 'arancel_id');
	}
}
