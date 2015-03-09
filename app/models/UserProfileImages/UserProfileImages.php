<?php
namespace UserProfileImages;
/**
 * main model for UserProfileImages
 * */

class UserProfileImages extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_profile_images';

	public function user(){
		return $this->belongsTo('\User\User','user_id','id');
	}

}
