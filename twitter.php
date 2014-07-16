<?php
/**
 *  Connect Twitter Helper
 *  @author Goma.Nanoha <goma@goma-gz.net>
 *  @version 1.0
*/

class Twitter
{

    public $OAuth;

    public function __construct()
    {

        $Appkey         = '';
        $AppSecret      = '';
        $AccessToken    = '';
        $AccessSecret   = '';

        $this->OAuth = new tmhOAuth(array(
            'consumer_key'          => $Appkey,
            'consumer_secret'       => $AppSecret,
            'token'                 => $AccessToken,
            'secret'                => $AccessSecret,
            'curl_ssl_verifypeer'   => false
        ));

    }

    public function tweet($message, $reply = null)
    {

        $this->OAuth->user_request(array(
            'method'    =>  'POST',
            'url'       =>  $this->OAuth->url('1.1/statuses/update.json'),
            'params'    =>  array('status'  =>  $message, 'in_reply_to_status_id'   =>  $reply)
        ));

        return $this->OAuth->response;

    }

    public function home_timeline($count = 10)
    {

        $this->OAuth->user_request(array(
            'method'    =>  'GET',
            'url'       =>  $this->OAuth->url('1.1/statuses/home_timeline.json'),
            'params'    =>  array('count'   =>  $count)
        ));

        return $this->OAuth->response;

    }

    public  function mentions_timeline($count = 10)
    {

        $this->OAuth->user_request(array(
            'methot'    =>  'GET',
            'url'       =>  $this->OAuth->url('1.1/statuses/mentions_timeline.json'),
            'params'    =>  array('count'   =>  $count)
        ));

        return $this->OAuth->response;

    }

    public function retweet($id)
    {

        $this->OAuth->user_request(array(
            'method'    =>  'POST',
            'url'       =>  $this->OAuth->url('1.1/statuses/retweet/'.$id.'.json')
        ));

        return $this->OAuth->response;

    }

    public function verify_credentials()
    {

        $this->OAuth->user_request(array(
            'method'    =>  'GET',
            'url'       =>  $this->OAuth->url('1.1/account/verify_credentials.json')
        ));

        return $this->OAuth->response;

    }

}
