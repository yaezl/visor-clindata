<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Key
 * 
 * @property int $id
 * @property string|null $key
 * @property string|null $level
 * @property string|null $ignore_limits
 * @property string|null $date_created
 *
 * @package App\Models
 */
class Key extends Model
{
	protected $table = 'keys';
	public $timestamps = false;

	protected $fillable = [
		'key',
		'level',
		'ignore_limits',
		'date_created'
	];
}
