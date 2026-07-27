<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ConfigDialog
 * 
 * @property int $id
 * @property int $width
 * @property int $height
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string $codigo
 * 
 * @property Collection|Feature[] $features
 *
 * @package App\Models
 */
class ConfigDialog extends Model
{
	use SoftDeletes;
	protected $table = 'config_dialog';

	protected $casts = [
		'width' => 'int',
		'height' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int'
	];

	protected $fillable = [
		'width',
		'height',
		'created_by',
		'modified_by',
		'deleted_by',
		'codigo'
	];

	public function features()
	{
		return $this->hasMany(Feature::class, 'configdialog_id');
	}
}
