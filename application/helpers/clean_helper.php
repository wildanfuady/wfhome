<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('set_linkurl')){

  // function untuk membersihkan karakter khusus menjadi kosong khusus non email 
  function xss($teks){
    //buat array untuk memasukan beberapa karakter
    $char = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','/','\\',',','.','#',':',';','\'','"','[',']', '<', '>');
    //ubah struktur string pada $char menjadi kosong
    $xss = str_replace($char,"",$teks);
	  return $xss;
  }
  // function untuk membersihkan karakter khusus menjadi kosong khusus email 
  function xssForMail($teks){
    //buat array untuk memasukan beberapa karakter
    $char = array ('{','}',')','(','|','`','~','!','%','$','^','&','*','=','?','+','/','\\',',','#',':',';','\'','"','[',']', '<', '>');
    //ubah struktur string pada $char menjadi kosong
    $xss = str_replace($char,"",$teks);
	  return $xss;
  }
  function set_linkurl($string){
    //buat array untuk memasukan beberapa karakter
    $char = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','/','\\',',','.','#',':',';','\'','"','[',']');
    //ubah huruf menjadi kecil
    //rubah struktur string pada $char menjadi kosong
    $del_char = strtolower(str_replace($char,"",$string));
    //ubah huruf menjadi kecil
    //rubah struktur string yang kosong dengan memberi karakter strip (-)
    $add_strip = strtolower(str_replace(' ', '-', $del_char));
    $clean_url = $add_strip;
	return $clean_url;
  }
	
}
?>
