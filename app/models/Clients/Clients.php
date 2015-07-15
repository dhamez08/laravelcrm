<?php
namespace Clients;
/**
 * main model for Clients
 * */

class Clients extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    use \SoftDeletingTrait;
    protected $dates = ['deleted_at'];
	protected $table = 'customer';

	protected $fillable = array(
		'ref',
		'type',
		'belongs_to',
		'belongs_user',
		'first_name',
		'last_name',
		'title',
		'company_name',
		'profile_image'
	);

	public function address(){
		return $this->hasOne('\CustomerAddress\CustomerAddress','customer_id','id');
	}

	public function task(){
		return $this->hasMany('\CustomerTasks\CustomerTasks','customer_id','id');
	}

	public function telephone(){
		return $this->hasMany('\CustomerTelephone\CustomerTelephone','customer_id','id');
	}

	public function emails(){
		return $this->hasMany('\CustomerEmail\CustomerEmail','customer_id','id');
	}

	public function url(){
		return $this->hasMany('\CustomerUrl\CustomerUrl','customer_id','id');
	}

	public function profileImage(){
		return $this->hasMany('\CustomerProfileImages\CustomerProfileImages','customer_id','id');
	}

	public function notes(){
		return $this->hasMany('\CustomerNotes\CustomerNotes','customer_id','id');
	}

	public function myTag(){
		return $this->hasMany('\CustomerTags\CustomerTags','customer_id','id');
	}

    public function customFieldsData() {
        return $this->hasMany('\CustomFieldData\CustomFieldData','customer_id','id');
    }

	public function scopeClientId($query, $id){
		return $query->where('id','=',$id);
	}

	public function scopeCustomerType($query, $arrayType){
		return $query->whereIn('type', $arrayType);
	}

	public function scopeCustomerBelongsTo($query, $belongsTo){
		return $query->where('belongs_to','=',$belongsTo);
	}

	public function scopeCustomerBelongsUser($query, $belongsTo){
		return $query->where('belongs_user','=',$belongsTo);
	}

	public function scopeCustomerBelongsUserIn($query, $belongsUserIn){
		return $query->whereIn('belongs_user', $belongsUserIn);
	}	

	public function scopeRelationshipIn($query, $relationshipArray) {
		return $query->whereIn('relationship', $relationshipArray);
	}

	public function scopeRelationshipNotIn($query, $relationshipArray) {
		return $query->whereNotIn('relationship', $relationshipArray);
	}

	public function scopeBirthdayThisWeek($query) {
		return $query->whereRaw(\DB::raw("DATE_FORMAT(dob, '%m-%d') between
											DATE_FORMAT(adddate(curdate(), INTERVAL 1-DAYOFWEEK(curdate()) DAY), '%m-%d')	
											AND
											DATE_FORMAT(adddate(curdate(), INTERVAL 7-DAYOFWEEK(curdate()) DAY), '%m-%d')"
											)
		);
	}

	public function scopeBirthdayThisMonth($query) {
		return $query->whereRaw(\DB::raw('MONTH(dob) = MONTH(NOW())'));
	}

	/**
	 * Person that is associated to
	 * */
	public function scopeCustomerAssociatedTo($query, $associated){
		return $query->where('associated','=',$associated);
	}

	public function opportunities() {
		return $this->hasMany('\CustomerOpportunities\CustomerOpportunities','customer_id','id');
	}

}
