<?php

class ProductContainer {
	
	public $productName="";  
	public $productPrice="";  
	public $productPageCount="";  
	public $productISBN="";  
	
	public function __construct()
	{
			//this looks different than other OOP languages
//		$this->productName = "test";
	}
	
	// Methods
  public function set_name($name) {
    $this->productName = $name;
  }  
  public function set_price($price) {
    $this->productPrice = $price;
  }
  public function set_pageCount($count) {
    $this->productPageCount = $count;
  }  
  public function set_ISBN($isbn) {
    $this->productISBN = $isbn;
  }
  
  public function get_name() {
    return $this->productName;
  }  
  public function get_price() {
    return $this->productPrice;
  }
  public function get_pageCount() {
    return $this->productPageCount;
  }  
  public function get_ISBN() {
    return $this->productISBN;
  }
  
}
?>

