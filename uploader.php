<?php
if(isset($_POST['submit'])){
	$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //if($check !== false) {
      //  $success = "File is an image - " . $check["mime"] . ".";
        //$uploadOk = 1;
    //} else {
      //  $error = "File is not an image.";
        //$uploadOk = 0;
    //}
}
// Check if file already exists
if (file_exists($target_file)) {
    $error = "Sorry, het bestand bestaat al.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 3000000) {
    $error = "Sorry, het bestand is te groot. Maximale uploadgrootte 3MB.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "sql" && $imageFileType != "doc"
&& $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "pdf") {
    $error = "Sorry, enkel afbeeldingen, PDF, Word, Excel en SQL bestanden zijn toegestaan.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $success = "<!--Sorry, your file was not uploaded.-->";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $success = "Het bestand is succesvol geupload. Je kan hem nu delen via de volgende URL: <a href='https://vmxmedia.nl/uploads/" . basename( $_FILES["fileToUpload"]["name"]). "' target=_blank>https://vmxmedia.nl/uploads/" . basename( $_FILES["fileToUpload"]["name"]). "</a>";
    } else {
        $success = "Sorry, there was an error uploading your file.";
    }
}
}
?>
<html>
<head>
	<title>
		vmxmedia.nl - uploader
	</title>

	<style>
	* { font-family: verdana; font-size: 10pt;  }
	b { font-weight: bold; }
	table { height: 10%; border: 1px solid gray;}
	td { text-align: center; padding: 25;}

	</style>
</head>
<body>
<center>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<table>
	<tr><td><br /><b>
<form action="" method="post" enctype="multipart/form-data">
    Selecteer het bestand dat je wil uploaden:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload bestand" name="submit" id="submit">
</form></b>
<?php
if (isset($success)){ echo "<div><font color='#00cc00'>" . $success . "</div></font>";}?>
<?php
if (isset($error)){ echo "<div><font color='#ff0000'>" . $error . "</div></font>";}?>
</td></tr>
	</table>
<br /><br />

</center>

</body>
</html>