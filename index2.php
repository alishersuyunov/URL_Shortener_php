<?

require "../db.php";

$url=str_replace("/","",$_SERVER['REQUEST_URI']);



$manzil=R::findone('adreslar', 'adres1=?',array ($url));
	if ($manzil)
	{
		//url bor
$manzil0=$manzil->adres0;
	
echo $manzil0;
if (strpos($manzil,"tp")) {	header("Location:$manzil0");die()	;	} else {	header("Location:http://$manzil0");die()	;	}





header("Location:$manzil0");
die()	;			
		
	} else { $errors[]='Manzilni yuklashda xatolik yuz berdi';
}


if (empty($errors))
{
;
}

else {echo array_shift($errors);}

?>

