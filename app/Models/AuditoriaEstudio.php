<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditoriaEstudio
 * 
 * @property int $id
 * @property int $auditoria_id
 * @property int $item_id
 * @property int|null $estudio_id
 * @property bool $eliminado
 * 
 * @property AutorizacionesItem $autorizaciones_item
 * @property Estudio|null $estudio
 * @property AutorizacionesAuditoriaEstado $autorizaciones_auditoria_estado
 *
 * @package App\Models
 */
class AuditoriaEstudio extends Model
{
	protected $table = 'auditoria_estudio';
	public $timestamps = false;

	protected $casts = [
		'auditoria_id' => 'int',
		'item_id' => 'int',
		'estudio_id' => 'int',
		'eliminado' => 'bool'
	];

	protected $fillable = [
		'auditoria_id',
		'item_id',
		'estudio_id',
		'eliminado'
	];

	public function autorizaciones_item()
	{
		return $this->belongsTo(AutorizacionesItem::class, 'item_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function autorizaciones_auditoria_estado()
	{
		return $this->belongsTo(AutorizacionesAuditoriaEstado::class, 'auditoria_id');
	}
}
