<?php

class Arr {
	private $array;
	
	public function __construct($newarray) {
		$this->setArray($newarray);
	}
	
	public function setArray($newarray) {
		$this->array = $newarray;
	}
	
	public function add($value) {
		return $this->array[] = $value;
	}
	
	public function get($key) {
		return $this->array[$key];
	}
	
	public function put($key, $value) {
		return $this->array[$key] = $value;
	}
	
	public function length() {
		return count($this->array);
	}
	
	public function last($value = NULL) {
		if (isSet($this->array[count($this->array) - 1])) {
			if (is_null($value)) {
				return $this->array[count($this->array) - 1];
			} else {
				return $this->array[count($this->array) - 1] = $value;
			}
		} else {
			$mykey;
			foreach ($this->array as $key => $value) {
				$mykey = $key;
			}
			
			if (is_null($value)) {
				return $this->array[$mykey];
			} else {
				return $this->array[$mykey] = $value;
			}
		}
		
	}
}

?>