<?php


	class commoncontroller
	{

		public function singleFileUpload($target_dir,$fileName,$fileNameTmp,$fileSize,$size) 
		{
			//$target_dir = "uploads/";
			$target_file = $target_dir . basename($fileName);
			$uploadOk = 99;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			/*if(isset($_POST["submit"])) {
			    $check = getimagesize($fileNameTmp);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 1;
			    }
			}*/
			// Check if file already exists
			/*if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 2;
			}*/
			// Check file size
			if ($fileSize > $size) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 3;
			}
			// Allow certain file formats
			/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}*/
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk!= 99) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($fileNameTmp, $target_file)) {
			        echo "The file ". basename( $fileName). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			        $uploadOk = 90;
			    }
			}
			return $uploadOk.':'.$target_file;

		}
	}
?>