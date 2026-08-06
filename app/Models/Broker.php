<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Broker
 * 
 * @property int $id
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Collection|BrokerConfig[] $broker_configs
 *
 * @package App\Models
 */
class Broker extends Model
{
	protected $table = 'broker';
	public $timestamps = false;

	protected $casts = [
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'modified_at'
	];

	public function broker_configs()
	{
		return $this->hasMany(BrokerConfig::class);
	}
}
