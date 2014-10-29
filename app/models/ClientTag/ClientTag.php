<?php
namespace ClientTag;
class ClientTag extends \Eloquent{
	protected $table = 'tags';

	public function customertags(){
		return $this->hasMany('\CustomerTags\CustomerTags');
	}
}
