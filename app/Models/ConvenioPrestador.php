<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConvenioPrestador
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $convenio_id
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * @property Carbon $inicio_vigencia
 * @property Carbon $fin_vigencia
 * @property int|null $prestadorInstitucion_id
 * 
 * @property PrestadorInstitucion|null $prestador_institucion
 * @property Usuario|null $usuario
 * @property Convenio|null $convenio
 *
 * @package App\Models
 */
class ConvenioPrestador extends Model
{
	protected $table = 'convenio_prestador';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'convenio_id' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'inicio_vigencia' => 'datetime',
		'fin_vigencia' => 'datetime',
		'prestadorInstitucion_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'convenio_id',
		'modified_at',
		'borrado_logico',
		'inicio_vigencia',
		'fin_vigencia',
		'prestadorInstitucion_id'
	];

	public function prestador_institucion()
	{
		return $this->belongsTo(PrestadorInstitucion::class, 'prestadorInstitucion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function convenio()
	{
		return $this->belongsTo(Convenio::class);
	}
}
