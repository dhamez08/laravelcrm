<?php
namespace UserMeta;

class UserMeta extends \Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_meta';

	protected $softDelete = true;

	protected $array_not_included_data = array(
		'_token',
	);

	protected $fillable = array(
		'users_id',
		'meta_key',
		'meta_value',
	);

	protected $guarded = array('id');

	public function user(){
        return $this->belongsTo('\User\User');
    }

	public function scopeUserId($query, $user_id)
	{
		return $query->where('users_id', '=', $user_id);
	}

	public function scopeMetaKey($query, $meta_key)
	{
		return $query->where('meta_key', '=', $meta_key);
	}

	public function scopeMetaValue($query, $meta_value)
	{
		return $query->where('meta_value', '=', $meta_value);
	}

	public function scopeUserMetaKey($query, $user_id, $meta_key)
	{
		//return $query->whereRaw("( re_user_meta.user_id = $user_id OR re_user_meta.meta_key = '$meta_key' )");
	}
}
