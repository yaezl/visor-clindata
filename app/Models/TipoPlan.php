<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoPlan
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
 * @property Collection|Bono[] $bonos
 * @property Collection|DebitosYCredito[] $debitos_y_creditos
 * @property Collection|PersonaPlan[] $persona_plans
 * @property Collection|Prefactura[] $prefacturas
 *
 * @package App\Models
 */
class TipoPlan extends Model
{
	protected $table = 'tipo_plan';

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

	public function bonos()
	{
		return $this->hasMany(Bono::class, 'condicion_iva');
	}

	public function debitos_y_creditos()
	{
		return $this->hasMany(DebitosYCredito::class, 'iva_id');
	}

	public function persona_plans()
	{
		return $this->hasMany(PersonaPlan::class, 'condicion_iva_id');
	}

	public function prefacturas()
	{
		return $this->hasMany(Prefactura::class, 'condicion_iva');
	}
}
