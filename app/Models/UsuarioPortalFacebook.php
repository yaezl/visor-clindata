<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPortalFacebook
 * 
 * @property int $id
 * @property string $email_fb
 * 
 * @property UsuarioPortal $usuario_portal
 *
 * @package App\Models
 */
class UsuarioPortalFacebook extends Model
{
	protected $table = 'usuario_portal_facebook';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'email_fb'
	];

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class, 'id');
	}
}
