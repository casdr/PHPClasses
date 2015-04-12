<?php
/**
Post a tweet without using the twitter API.

Example:
$user='twittername';
$password='twitterpassword';
$text = 'Hello World!';

$bot=new Bot("https://mobile.twitter.com/session/new");
$html=$bot->request();
preg_match("/input name=\"authenticity_token\" type=\"hidden\" value=\"(.*?)\"/", $html, $authenticity_token);
$authenticity_token=$authenticity_token[1];
$bot->setUrl("https://mobile.twitter.com/session");
$html=$bot->request("authenticity_token={$authenticity_token}&username=$user&password=$password");
foreach($messages as $text) {
        $bot->setUrl("https://mobile.twitter.com/");
        $html=$bot->request("authenticity_token={$authenticity_token}&tweet[text]=$text&commit=Tweet");
}
$bot->setUrl("https://mobile.twitter.com/session/destroy");
$html=$bot->request("authenticity_token={$authenticity_token}&commit=Sign out");
$bot->closeConnection();
**/

class Bot
{
	private $url;
	private $conn;
	private $user_agent;
	private $debug=false;
	private $cookie="cookies.txt_file";
	
	/*__construct*/
	public function __construct($url_input=""){
		$this->conn=curl_init();
		$this->setUrl($url_input);
		$this->setUserAgent($this->getUserAgent());
	}
	/*END -__construct*/
	/*__destruct*/
	public function __destruct(){
		$this->conn=null;
		$this->url="";
		$this->user_agent="";
		$this->cookie="";
    }
	/*END __destruct*/
	
	/*function*/
	public function request($post=false){
		if($this->conn!=null){
			curl_setopt($this->conn, CURLOPT_URL, $this->getUrl());
			if($post){
				curl_setopt($this->conn,CURLOPT_POSTFIELDS, $post);
				curl_setopt($this->conn, CURLOPT_POST, 1);
			}
			else{
				curl_setopt($this->conn, CURLOPT_POST, 0);
			}
			curl_setopt($this->conn, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->conn, CURLOPT_COOKIEJAR, $this->cookie);
			curl_setopt($this->conn, CURLOPT_HEADER, 0);
			curl_setopt($this->conn, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($this->conn, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->conn, CURLOPT_USERAGENT, $this->user_agent);
			return curl_exec($this->conn);
		}
		return null;
	}
	public function closeConnection(){
		if($this->conn!=null){
			curl_close($this->conn);
		}
	}
	public function getUserAgent(){
		$agents = array(
			'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; NOKIA; Lumia 800)'
		);
		return $agents[array_rand($agents)];
	}
	/*END- function*/
	
	/*GET-SETTERS VARIABLE*/
	public function setUrl($url_input){
		$this->url=$url_input;
	}
	public function getUrl(){
		return $this->url;
	}
	public function setUserAgent($agent){
		$this->user_agent=$agent;
	}
	public function getUserAgentVar(){
		return $this->user_agent;
	}
	/*END-GET-SETTERS VARIABLE*/
}
?>
