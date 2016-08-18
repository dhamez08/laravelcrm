<?php
namespace ViewMyDocuments;
class ViewMyDocuments extends \Eloquent{
    protected static $instance = null;
    protected $api_base_url;
    protected $api_username;
    protected $api_password;

    public function __construct(){
        $this->api_base_url = 'http://www.viewmydocuments.co.uk/v1/api';
        $this->api_username = 'b77d25a87d486c923748da5700c4b363';
        $this->api_password = '3ae6f7de5112d8b0d1ec3d7016a546df';
    }

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function activate($user_details){
        $curl = new \anlutro\cURL\cURL;
        $endpoint = '/clients/users';

        $request = $curl
            ->newRequest('post', $this->api_base_url.$endpoint, $user_details)
            ->setUser($this->api_username)
            ->setPass($this->api_password);
        $response = $request->send();

        $client = json_decode($response->body);

        return $client;
    }

    public function deactivate($vmd_client_id){
        $endpoint = '/clients/users';
        $user_data = array('id' => $vmd_client_id);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_base_url.$endpoint);
        curl_setopt($ch, CURLOPT_USERPWD, $this->api_username . ":" . $this->api_password);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($user_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, TRUE);
    }

    public function get_vmd_details($vmd_id){
        // Get client data in API
        $curl = new \anlutro\cURL\cURL;
        $endpoint = '/clients/users/id/'.$vmd_id;

        $request = $curl
            ->newRequest('get', $this->api_base_url.$endpoint)
            ->setUser($this->api_username)
            ->setPass($this->api_password);
        $response = $request->send();

        $client = json_decode($response->body);
        return $client;
    }

    public function get_shared_files($vmd_client_id, $page_index = 1, $page_size = 999){
        $curl = new \anlutro\cURL\cURL;
        $endpoint = '/clients/files/client_id/'.$vmd_client_id.'/page_ndx/'.$page_index.'/page_size/'.$page_size.'/type/shared';

        $request = $curl
            ->newRequest('get', $this->api_base_url.$endpoint)
            ->setUser($this->api_username)
            ->setPass($this->api_password);
        $response = $request->send();

        $downloads = json_decode($response->body);

        if(isset($downloads->shared))
            return $downloads->shared;
        else
            return FALSE;
    }

    public function get_uploaded_files($vmd_client_id, $page_index = 1, $page_size = 999){
        $curl = new \anlutro\cURL\cURL;
        $endpoint = '/clients/files/client_id/'.$vmd_client_id.'/page_ndx/'.$page_index.'/page_size/'.$page_size.'/type/uploaded';

        $request = $curl
            ->newRequest('get', $this->api_base_url.$endpoint)
            ->setUser($this->api_username)
            ->setPass($this->api_password);
        $response = $request->send();

        $uploads = json_decode($response->body);

        if(isset($uploads->uploaded))
            return $uploads->uploaded;
        else
            return FALSE;
    }
}
