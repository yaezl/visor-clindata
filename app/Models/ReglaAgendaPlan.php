<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaPlan
 * 
 * @property int $id
 * @property int|null $plan_id
 * @property int $cantidad
 * @property bool $os_completa
 * 
 * @property ReglaAgenda $regla_agenda
 * @property Plan|null $plan
 *
 * @package App\Models
 */
class ReglaAgendaPlan extends Model
{
	protected $table = 'regla_agenda_plan';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'plan_id' => 'int',
		'cantidad' => 'int',
		'os_completa' => 'bool'
	];

	protected $fillable = [
		'plan_id',
		'cantidad',
		'os_completa'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
