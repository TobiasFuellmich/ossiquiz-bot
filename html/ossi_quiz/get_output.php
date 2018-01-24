<?php
/*$options = [
    'cost' => 11,
];
echo password_hash("", PASSWORD_BCRYPT, $options);*/
/*if(password_verify ( $_POST['pw'], '$2y$11$qIJ18JhwTFojIrwKKXv30e6khtIi4YYY0GUZqbKAfe6fZombAlabG')!=1){
	echo "nope";
	exit;
}else{*/
	echo "in";
	echo file_get_contents("/var/www/html/ossi_quiz/ossi_output.lock");
/*}*/
?>