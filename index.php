<? require "db.php";
require "base58.php";
$domain="http://10.0.101.194/";
$TEXT="";

// function randomString($length = 4) {
	// /*
 // * Create a random string
 // * @author	XEWeb <>
 // * @param $length the length of the string to create
 // * @return $str the string
 // */
 // $str = "";
	// $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	// $max = count($characters) - 1;
	// for ($i = 0; $i < $length; $i++) {
		// $rand = mt_rand(0, $max);
		// $str .= $characters[$rand];
	// }
	// return $str;
// }


$data=$_POST;
if (isset($data['do_short']))
{

 if (R::count('adreslar', "adres0=?",array($data['manzil']))>0)
 {

//bor adres, o'shani chiqar
 $qidir=R::findone('adreslar',"adres0=?",array($data['manzil']));
echo $qidir->adres1; 
 $errors[]="Bunday adres mavjud";
$zzz2="<h2> <a href='$domain$qidir->adres1'>".$domain."".$qidir->adres1."</a></h2>";

}



$boolast = R::findlast( 'adreslar');
$newnumber=1+$boolast->id;

$new_manzil=base58::encode($newnumber);
//$new_manzil='kk'.randomString();

//echo $new_manzil;
if (empty($errors))
{
//qisqaritirlgan url qilsa bo'ladi
$user=R::dispense('adreslar');
$user->adres0=$data['manzil'];
$user->adres1=$new_manzil;
$user->joindate=time();

R::store($user);
	//echo "Yangi URL kiritildi";
//Ro'yxatdan 	o'tdi
	
if (!file_exists('$new_manzil')) {
    mkdir($new_manzil, 0777, true);
	$file='index2.php';
	$newfile=$new_manzil."/index.php";
	copy($file, $newfile);
	echo "<br>";
	$TEXT= " ".$domain."".$new_manzil."";
	
	}
}

else {$zz=array_shift($errors);}
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>URL Shortener</title>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>

  <div class="site-wrapper">
    <div class="site-wrapper-inner">
      <div class="main-container">
        <div class="inner cover">
          <span class="glyphicon glyphicon-link"></span>
          <h1>URL Shortener</h1>
          <h4>qisqa.cf</h4>
<body>

<form action="index.php" method="POST">
<div class="row">
<div class="input-group ">
<div>
<input id="url-field" type="url" class="form-control"  name="manzil" minlengvalue="3" value="<?echo @$data['manzil']; ?>" required="" />
</div>              
<span class="input-group-btn">
<button type="submit" class="btn btn-shorten" name="do_short">Qisqasi</button></span>
</div>
</div>

             
            </form>
			<? echo "<h2> <a href='$domain$new_manzil'>".$TEXT."</a></h2>";?>
			<? echo "<h2>$zz</h2>";
			echo "<h2>$zzz2</h2>";?>
			  <div class="col-lg-12">
              <div id="link"></div>
            </div>

          </div>

        </div>
      </div>
    </div>


  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="javascripts/shorten.js"></script>
<?
 


//echo base58::encode(387861);
//echo base58::decode('2Zig');
?>
</body>
</html>
			
			
			
			
			
			
			
			