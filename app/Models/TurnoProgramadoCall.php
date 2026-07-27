<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TurnoProgramadoCall
 * 
 * @property int $id
 * @property int|null $template_sms_id
 * @property string|null $estado_sms
 * @property int|null $template_email_id
 * @property string|null $estado_email
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * 
 * @property TurnoProgramado $turno_programado
 *
 * @package App\Models
 */
class TurnoProgramadoCall extends Model
{
	protected $table = 'turno_programado_call';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'template_sms_id' => 'int',
		'template_email_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'template_sms_id',
		'estado_sms',
		'template_email_id',
		'estado_email',
		'created_by',
		'modified_by'
	];

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class, 'id');
	}
}
