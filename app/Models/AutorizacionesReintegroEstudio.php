<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesReintegroEstudio
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $estudio_id
 * @property int|null $reintegro_id
 * @property float $precio
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Estudio|null $estudio
 * @property AutorizacionesReintegro|null $autorizaciones_reintegro
 *
 * @package App\Models
 */
class AutorizacionesReintegroEstudio extends Model
{
	protected $table = 'autorizaciones_reintegro_estudios';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'estudio_id' => 'int',
		'reintegro_id' => 'int',
		'precio' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'estudio_id',
		'reintegro_id',
		'precio',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function autorizaciones_reintegro()
	{
		return $this->belongsTo(AutorizacionesReintegro::class, 'reintegro_id');
	}
}
