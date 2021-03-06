<?php
namespace Marketing;

class MarketingEntity{

	protected static $instance = null;

	public function __construct(){

	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function getCustomerList($tag_id = null, $phone_type = 'Mobile', $otherFilters = array()){
		$type = array(1);
		$client = \Clients\Clients::customerType($type)
		->customerBelongsUser(\Auth::id())
		->with(array('myTag' => function($query) use ($tag_id)
		{
			if(is_array($tag_id)) {
				foreach ($tag_id as $tag) {
					$query->where('tag_id', '=', $tag);
				}
			} else {
				$query->where('tag_id', '=', $tag_id);
			}
		}))
		->with(array('telephone' => function($query) use ($phone_type)
		{
			/**
			* we get only the one
			* why we need the one mobile only?
			* the old code crm does this,
			* perhaps we can dislay them all and choose?
			* - for now display and get one only
			* */
			$query->where('type', '=', $phone_type);
		}));

		// other filters		
		if(isset($otherFilters['min_age'])) {
			$client->where(\DB::raw('TIMESTAMPDIFF(YEAR, dob, CURDATE())'), '>=', $otherFilters['min_age']);
		}
		if(isset($otherFilters['max_age'])) {
			$client->where(\DB::raw('TIMESTAMPDIFF(YEAR, dob, CURDATE())'), '<=', $otherFilters['max_age']);
		}
		if(isset($otherFilters['marital_status'])) {
			$client->where('marital_status', $otherFilters['marital_status']);
		}

		return $client;
	}

	public function getSMSCredit($user_id){
		$check_credit = \SMSCredit\SMSCredit::userId($user_id)->get();
		return $check_credit;
	}

	public function sendSMS($number, $message, $user_id){
		$characters 	= strlen($message);
		$used_credits 	= ceil($characters/160);
		if( \SMSCredit\SMSCreditEntity::get_instance()->spendCredit($user_id,$used_credits) ){
			$sms = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
			$numbers = array($number);
			$message = $message;
			$sender = \Auth::user()->sms;
			$response = $sms->sendSMS($numbers, $message, $sender, null);
			return $response;
		}else{
			return false;
		}
	}

    public function getCustomerEmails($tag_id = null, $otherFilters = array()){
        $type = array(1);
        $client = \Clients\Clients::customerType($type)
            ->customerBelongsUser(\Auth::id())
            ->with(array('myTag' => function($query) use ($tag_id)
                {
                    if(is_array($tag_id)) {
                        foreach ($tag_id as $tag) {
                            $query->where('tag_id', '=', $tag);
                        }
                    } else {
                        $query->where('tag_id', '=', $tag_id);
                    }
                }))
            ->with('emails');

        // other filters
        if(isset($otherFilters['min_age'])) {
            $client->where(\DB::raw('TIMESTAMPDIFF(YEAR, dob, CURDATE())'), '>=', $otherFilters['min_age']);
        }
        if(isset($otherFilters['max_age'])) {
            $client->where(\DB::raw('TIMESTAMPDIFF(YEAR, dob, CURDATE())'), '<=', $otherFilters['max_age']);
        }
        if(isset($otherFilters['marital_status'])) {
            $client->where('marital_status', $otherFilters['marital_status']);
        }

        return $client;
    }

}
