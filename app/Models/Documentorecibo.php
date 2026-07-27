<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Documentorecibo
 * 
 * @property int $id
 * @property int $numero
 * @property Carbon $fecha
 * @property string|null $concepto
 * 
 * @property Documento $documento
 *
 * @package App\Models
 */
class Documentorecibo extends Model
{
	protected $table = 'documentorecibo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'numero' => 'int',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'numero',
		'fecha',
		'concepto'
	];

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}
}
