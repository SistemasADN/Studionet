<?php	
class RandomLib{
	
	var $allowed = "";
	
	function generateRandom256Int(){
		return ord(openssl_random_pseudo_bytes(1));
	}
	
	function add_allow_alpha(){
		$this->allowed .= "abcdefghijklmnopqrstuvwxyz";
		$this->allowed = count_chars($this->allowed,3);
	}
	
	function add_allow_alpha_caps(){
		$this->allowed .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$this->allowed = count_chars($this->allowed,3);
	}
	
	function add_allow_num(){
		$this->allowed .= "1234567890";
		$this->allowed = count_chars($this->allowed,3);
	}
	
	function add_allow_specials(){
		$this->allowed .= "+-_*.:";
		$this->allowed = count_chars($this->allowed,3);
	}
	
	function setAllowedString($string){
		$this->allowed = $string;
	}
	function add_allow_extra($string){
		$this->allowed .= $string;
		$this->allowed = count_chars($this->allowed,3);
	}
	function add_allow_alphnum(){
		$this->add_allow_alpha();
		$this->add_allow_alpha_caps();
		$this->add_allow_num();
	}
	
	function random_256int($min, $max){
		if($min<0){
			die("random_int: Error, min es menor a 0");
		}else if($max<0){
			die("random_int: Error, max es menor a 0");
		}else if($min>$max){
			die("random_int: Error, min es mayor que max");
		}else if($min>256){
			die("random_int: Error, min es mayor a 256");
		}else if($max>256){
			die("random_int: Error, max es mayor a 256");
		}
		
		$num = 0;
		
		do{
			$num = $this->generateRandom256Int();
		}while($num<$min||$num>$max);
	
		return $num;
	}
	
	
	
	function generateString($length){
		
		if(strlen($this->allowed)<1){
			die("generateString: Error, allowed esta vacio, usar setAllowedString(string) o add_allow_[alpha|alphnum|num|special|alpha_caps|extra(string)]");
		}
		
		if($length<1){
			die("generateString: Error, tamano del string especificado es menor que 1");
		}
		
		$lenAllow = strlen($this->allowed);
		$temp = "";
		for($i=0;$i<$length;$i++){
				 $temp .= substr($this->allowed, $this->random_256int(0,$lenAllow),1);
		}
		return $temp;
	}
}
?>