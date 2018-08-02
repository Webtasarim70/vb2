<?php 

require_once "ayar.php";

function post($parametre, $kosul = false){
        if( $kosul == false ){
            $sonuc = strip_tags(trim($_POST[$parametre]));
        }elseif( $kosul == true ){
            $sonuc = strip_tags(trim(addslashes($_POST[$parametre])));
        }
        return $sonuc;
    }

    function get($parametre, $kosul = false){
        if( $kosul == false ){
            $sonuc = trim(strip_tags($_GET[$parametre]));
        }elseif( $kosul == true ){
            $sonuc = addslashes(trim(strip_tags($_GET[$parametre])));
        }
        return $sonuc;
    }

    function sef_link($str){
        $preg = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
        $match = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
        $perma = strtolower(str_replace($preg, $match, $str));
        $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
        $perma = trim(preg_replace('/\s+/', ' ', $perma));
        $perma = str_replace(' ', '-', $perma);
        return $perma;
    }

    
    function IP(){
        if(getenv("HTTP_CLIENT_IP")){
            $ip = getenv("HTTP_CLIENT_IP");
        }elseif(getenv("HTTP_X_FORWARDED_FOR")){
            $ip = getenv("HTTP_X_FORWARDED_FOR");
            if (strstr($ip, ',')) {
                $tmp = explode (',', $ip);
                $ip = trim($tmp[0]);
            }
        }else{
            $ip = getenv("REMOTE_ADDR");
        }
        return $ip;
    }

         function kategori_listele($ana_kategori_id,$kategori_id=0,$onek = 0) {
     //Alt Kategori çağıran fonksiyon başladı
     global $db; //PDO veritabanı değişkenini fonksiyon içinde kullanabilmek için global yaptık. 
 
     $kategoriler = $db -> prepare ("select * from kategori where ana_kategori_id=:kategori_id order by kategori_adi asc");
     $kategoriler -> execute (array("kategori_id"=>$kategori_id));
     while ($dizi = $kategoriler-> fetch (PDO::FETCH_ASSOC)) {
           $ana_kategori_adi = $dizi ["kategori_adi"];
           $kategori_id = $dizi ["kategori_id"]; 
 
           if ($kategori_id==$ana_kategori_id) {
                 $onay = 'selected';
           } else {
                 $onay = '';
           }
 
           $ekle=str_repeat('-', $onek);
           echo "<option value='$kategori_id' $onay>$ekle $ana_kategori_adi</option>";
 
           kategori_listele ($ana_kategori_id,$kategori_id,$onek+3);
      }
     //------------------------------------ 
 
    }








?>