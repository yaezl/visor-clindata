<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPortalEmail
 * 
 * @property int $id
 * @property string $email
 * @property bool $validado
 * 
 * @property UsuarioPortal $usuario_portal
 *
 * @package App\Models
 */
class UsuarioPortalEmail extends Model
{
	protected $table = 'usuario_portal_email';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'validado' => 'bool'
	];

	protected $fillable = [
		'email',
		'validado'
	];

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class, 'id');
	}
}
