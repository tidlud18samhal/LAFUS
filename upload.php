<?php 
   if (isset($_POST['submit'])){
	   $file = $_FILES['file'];
	   
	   
	   $fileName = $_FILES['file']['name'];
	   $fileTmpName = $_FILES['file']['tmp_name'];
	   $fileSize = $_FILES['file']['size'];
	   $fileError = $_FILES['file']['error'];
	   $fileType = $_FILES['file']['type'];
	   
	   $fileExt = explode('.', $fileName);
	   $fileActualExt = strtolower(end($fileExt));
	   
	   $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'xlsx');
	   
	   if (in_array($fileActualExt, $allowed)){
		 if ($fileError === 0){
			 if ($fileSize < 1000000){
			    $fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("location: index.php?uploadsuccess");
			 } else {
				 echo "Din fil verkar vara för stor. Försök med en annan eller minska nuvarande fil.";
			 }
			 
		 } else {
			 echo "Hmm, något gick fel. Försök igen senare eller testa något annat. ";
		 }
	   } else {
		   echo "Du kan inte ladda upp filer av denna typen.";
	   }
   }

?>
