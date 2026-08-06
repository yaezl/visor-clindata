<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConceptoCompensatorio
 * 
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property bool $borrado_logico
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $codigo
 * 
 * @property Usuario|null $usuario
 * @property Collection|Compensatorio[] $compensatorios
 *
 * @package App\Models
 */
class ConceptoCompensatorio extends Model
{
	protected $table = 'concepto_compensatorio';
	public $timestamps = false;

	protected $casts = [
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'nombre',
		'modified_at',
		'borrado_logico',
		'created_by',
		'modified_by',
		'codigo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function compensatorios()
	{
		return $this->hasMany(Compensatorio::class);
	}
}
