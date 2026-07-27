<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPortalGoogle
 * 
 * @property int $id
 * @property string $email_gm
 * 
 * @property UsuarioPortal $usuario_portal
 *
 * @package App\Models
 */
class UsuarioPortalGoogle extends Model
{
	protected $table = 'usuario_portal_google';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'email_gm'
	];

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class, 'id');
	}
}
