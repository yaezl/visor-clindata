<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TurneroMessage
 * 
 * @property int $id
 * @property int|null $turnero_id
 * @property string|null $mensaje
 * @property int $posicion
 * @property Carbon $modificado_en
 * 
 * @property Turnero|null $turnero
 *
 * @package App\Models
 */
class TurneroMessage extends Model
{
	protected $table = 'turnero_message';
	public $timestamps = false;

	protected $casts = [
		'turnero_id' => 'int',
		'posicion' => 'int',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'turnero_id',
		'mensaje',
		'posicion',
		'modificado_en'
	];

	public function turnero()
	{
		return $this->belongsTo(Turnero::class);
	}
}
