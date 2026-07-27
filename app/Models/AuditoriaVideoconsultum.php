<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditoriaVideoconsultum
 * 
 * @property int $id
 * @property int $usuario_id
 * @property string $evento
 * @property Carbon $created_at
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class AuditoriaVideoconsultum extends Model
{
	protected $table = 'auditoria_videoconsulta';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'usuario_id',
		'evento'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
