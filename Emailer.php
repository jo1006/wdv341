<?php

class Emailer {
	//This class will process a PHP email and send it
	
	//properties declaration
	
	//access identifier property name
	//private - property cant be accessed outside of object, only within
	private $message="";  
	private $recipientEmail="";
	private $senderEmail="";
	private $subject="";

	//constructor method
	//public can be accessed anywhere
	//1. DOES NOT make a new object - the Emailer newEmail = new Emailer() creates the new object
	//2. initializes the new object default values
	//cant do multiple constructors in PHP
	public function __construct()
	{
			//this looks different than other OOP languages
	}

	//methods
	//cant overload methods in PHP
	//processes properties of object
		//setter methods - used to set property values into the object
			//one method per property generally
		public function setMessage($inVal){
					$this->message = $inVal;		//assign input to message
		}
		public function setRecipientEmail($inVal){
					$this->recipientEmail = $inVal;	//assign input to recipientEmail
		}
		public function setSenderEmail($inVal){
					$this->senderEmail = $inVal;	//assign input to senderEmail
		}
		public function setSubject($inVal){
					$this->subject = $inVal;		//assign input to subject
		}
		
		//getter methods - return the property values from the object
			//one method per property
		public function getMessage(){
					return $this->message;			//assign output to message
		}
		public function getRecipientEmail(){
					return $this->recipientEmail;	//assign output to recipientEmail
		}
		public function getSenderEmail(){
					return $this->senderEmail;		//assign output to senderEmail
		}
		public function getSubject(){
					return $this->subject; 			//assign output to subject
		}

		//processing methods - everything else
			
		public function sendEmail() {
			//this will format and send an email to the SMTP server
			//it will use the PHP mail()
			$to = $this->getSenderEmail();
			$subject = $this->getSubject();
			$message = $this->getMessage();
			
			$headers = "From: <webiam@joannw.com>";
			
			return mail($to, $subject, $message, $headers);
			
		}

}

?>