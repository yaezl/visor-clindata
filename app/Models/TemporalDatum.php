<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemporalDatum
 * 
 * @property int $id
 * @property string $codigo
 * @property bool|null $value
 * @property string|null $extra_data
 * @property Carbon|null $date
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class TemporalDatum extends Model
{
	protected $table = 'temporal_data';
	public $timestamps = false;

	protected $casts = [
		'value' => 'bool',
		'date' => 'datetime'
	];

	protected $fillable = [
		'codigo',
		'value',
		'extra_data',
		'date'
	];
}
