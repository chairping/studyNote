<?php
// https://github.com/davestj/check_thatpass/blob/master/check_thatpass.php
class ThePassMan{

public      $password = "";
protected   $desc     = array(array());
public      $score    = int;
private     $strpass  = string;
public      $msg      = "";
public      $key      = "";

function check_thatpass($password){

$this->password = $password;

$this->desc[-1] = "Terrible";
$this->desc[0]  = "Super Weak";
$this->desc[1]  = "Weak Sauce";
$this->desc[2]  = "Meh, could be better";
$this->desc[3]  = "Sufficient";
$this->desc[4]  = "Acceptable";
$this->desc[5]  = "Solid";
$this->desc[6]  = "Best";


$this->score   = 0;
$this->strpass = strlen($this->password);

//if password bigger than 6 give 1 point
if($this->strpass > 6) {
    $this->score++;
    $this->msg = print("if password bigger than 6 give 1 point<br>");
}

//if password bigger than 8 give 1 point
if($this->strpass > 8) {
    $this->score++;
    $this->msg = print("if password bigger than 8 give 1 point<br>");
}
//if password bigger than 12 give 1 point
if($this->strpass > 12) {
    $this->score++;
    $this->msg = print("if password bigger than 12 give 1 point<br>");
}

//if password less than 6 characters take away 1 point
if($this->strpass < 6) {
    $this->score--;
    $this->msg = print("if password less than 6 characters take away 1 point<br>");
}
//if password has both lower and uppercase characters give 1 point
if(preg_match("/[a-z]/",$this->password) && preg_match("/[A-Z]/",$this->password)){
     $this->score++;
     $this->msg = print("if password has both lower and uppercase characters give 1 point<br>");
     }

//deduct points for stupid paterns
if(preg_match("/^123/",$this->passwordd)
    || preg_match("/^1234567/",$this->password)
    || preg_match("/^changeme/",$this->password)
    || preg_match("/^6543210/",$this->password)){
    $this->score--;
   $this->msg = print("deduct points for stupid paterns<br>");
}


//if password has at least one number give 1 point
 if(preg_match("/\d+/",$this->password)){
     $this->score++;
     $this->msg = print("if password has at least one number give 1 point<br>");
     }


//if password has at least one special caracther give 1 point
 if(preg_match("/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/",$this->password)){
     $this->score++;
     $this->msg = print("if password has at least one special caracther give 1 point<br>");
 }

return($this->desc[$this->score]);

}


public function gen_thathash($password){
    $this->password = $password;
    return (password_hash($this->password, PASSWORD_BCRYPT)."\n");
}

public function crypt_thatpass($key,$password){
    $this->password = (string) $password;
    $this->key       = $key;
    $iv_size        = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv             = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $txt     = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $this->password, MCRYPT_MODE_CBC, $iv);
    $txt     = $iv . $txt;
    $txt_64  = base64_encode($txt);

     return($txt_64 . "\n");

}

public function decrypt_thatpass($key,$password){
    $this->password = (string) $password;
    $this->key       = $key;
    $iv_size         = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

    $pass_dec = base64_decode( $this->password);

   //retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
    $iv_dec = substr($pass_dec, 0, $iv_size);

    // retrieves the cipher text (everything except the $iv_size in the front)
    $pass_dec = substr($pass_dec, $iv_size);

   // may remove 00h valued characters from end of plain text
    $_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key,
                                    $pass_dec, MCRYPT_MODE_CBC, $iv_dec);

    return( $_dec . "\n");
}

}


//EXAMPLE CASE USAGE
$_pass  = "g#Ti678Kd!l0D";
$passobj = new ThePassMan();
$mypass = $passobj->check_thatpass($_pass);

echo 'Your password of '.$_pass.' is '.$mypass.'  <br>';
$hashit = $passobj->gen_thathash($_pass);
echo "Hashed password result: $hashit <br>";

$crypted = $passobj->crypt_thatpass($_pass,$hashit);
echo "Crypted hash with password as key: $crypted<br>";

$decrypted = $passobj->decrypt_thatpass($_pass,$crypted);
echo "decrypted hash: $decrypted<br>";

?>
