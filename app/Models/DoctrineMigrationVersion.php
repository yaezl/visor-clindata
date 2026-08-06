<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctrineMigrationVersion
 * 
 * @property string $version
 * @property Carbon|null $executed_at
 * @property int|null $execution_time
 *
 * @package App\Models
 */
class DoctrineMigrationVersion extends Model
{
	protected $table = 'doctrine_migration_versions';
	protected $primaryKey = 'version';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'executed_at' => 'datetime',
		'execution_time' => 'int'
	];

	protected $fillable = [
		'executed_at',
		'execution_time'
	];
}
