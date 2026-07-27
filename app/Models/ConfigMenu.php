<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ConfigMenu
 * 
 * @property int $id
 * @property string $uri
 * @property string $tipo
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $feature_id
 * 
 * @property Feature|null $feature
 *
 * @package App\Models
 */
class ConfigMenu extends Model
{
	use SoftDeletes;
	protected $table = 'config_menu';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'feature_id' => 'int'
	];

	protected $fillable = [
		'uri',
		'tipo',
		'created_by',
		'modified_by',
		'deleted_by',
		'feature_id'
	];

	public function feature()
	{
		return $this->belongsTo(Feature::class);
	}
}
