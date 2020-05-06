<?php

class dogContainer {
	
	public $dogID="";  
	public $dogName="";  
	public $age="";  
	public $breed="";  
	public $owner="";  
	public $gender="";  
	public $vaccinated="";  
	
	public function __construct()
	{
			//this looks different than other OOP languages
//		$this->productName = "test";
	}
	
	// Methods
  public function set_id($dogID) {
    $this->dogID = $dogID;
  }  
  public function set_name($name) {
    $this->dogName = $name;
  }  
  public function set_age($age) {
    $this->age = $age;
  }
  public function set_breed($breed) {
    $this->breed = $breed;
  }  
  public function set_owner($owner) {
    $this->owner = $owner;
  }  
  public function set_gender($gender) {
    $this->gender = $gender;
  }  
  public function set_vaccinated($vaccinated) {
    $this->vaccinated = $vaccinated;
  }
  
  public function get_id() {
    return $this->dogID;
  }  
  public function get_name() {
    return $this->dogName;
  }  
  public function get_age() {
    return $this->age;
  }
  public function get_breed() {
    return $this->breed;
  }  
  public function get_owner() {
    return $this->owner;
  }  
  public function get_gender() {
    return $this->gender;
  }  
  public function get_vac() {
    return $this->vaccinated;
  }
  
}
?>

