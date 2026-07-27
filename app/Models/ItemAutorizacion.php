<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemAutorizacion
 * 
 * @property int $id
 * @property string $numeroAutorizacion
 * @property int $itemBonoId
 * @property bool|null $aInformar
 * @property bool|null $aInformarDiferido
 * @property string|null $tipoMedicoSolicitante
 * @property string|null $numeroMedicoSolicitante
 * @property Carbon|null $fechaReceta
 * @property string|null $extras
 * @property int|null $medicoSolicitante_id
 * 
 * @property Personal|null $personal
 *
 * @package App\Models
 */
class ItemAutorizacion extends Model
{
	protected $table = 'itemAutorizacion';
	public $timestamps = false;

	protected $casts = [
		'itemBonoId' => 'int',
		'aInformar' => 'bool',
		'aInformarDiferido' => 'bool',
		'fechaReceta' => 'datetime',
		'medicoSolicitante_id' => 'int'
	];

	protected $fillable = [
		'numeroAutorizacion',
		'itemBonoId',
		'aInformar',
		'aInformarDiferido',
		'tipoMedicoSolicitante',
		'numeroMedicoSolicitante',
		'fechaReceta',
		'extras',
		'medicoSolicitante_id'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'medicoSolicitante_id');
	}
}
