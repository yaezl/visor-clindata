<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosNotificacion
 * 
 * @property int $id
 * @property int|null $usuario_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon|null $fecha
 * @property string $mensaje
 * @property string|null $url
 * @property bool $visto
 * @property bool $cerrado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosNotificacion extends Model
{
	protected $table = 'suministros_notificacion';
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha' => 'datetime',
		'visto' => 'bool',
		'cerrado' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'usuario_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'fecha',
		'mensaje',
		'url',
		'visto',
		'cerrado',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
