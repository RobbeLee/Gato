<?php
<<<<<<< HEAD
    if(isset($_FILES['image'])){
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
    }
    // de explode string-functie breekt een string in een array
    // hierbij breek je de string na de . (punt) waardoor je de bestands type hebt
        $filename_deel = explode('.',$_FILES['image']['name']);
    // end laat de laatste waarde van de array zoen 
        $bestandstype = end($filename_deel); 
    // voor het geval er JPG ipv jpg is geschreven
        $file_ext = strtolower($bestandstype);
=======
    // if(isset($_FILES['image'])){
    //     $errors = array();
    //     $file_name = $_FILES['image']['name'];
    //     $file_size = $_FILES['image']['size'];
    //     $file_tmp = $_FILES['image']['tmp_name'];
    //     $file_type = $_FILES['image']['type'];
    // }
    // // de explode string-functie breekt een string in een array
    // // hierbij breek je de string na de . (punt) waardoor je de bestands type hebt
    //     $filename_deel = explode('.',$_FILES['image']['name']);
    // // end laat de laatste waarde van de array zoen 
    //     $bestandstype = end($filename_deel);
    // // voor het geval er JPG ipv jpg is geschreven
    //     $file_ext = strtolower($bestandstype);
>>>>>>> b98a79c3e4f84ce406563cb796da7a989e918f7a
    
    // $bestandstypen = ["jpeg","jpg","png"]; 
    // if(!in_array($file_ext,$bestandstypen)){
    //     $errors[] = "Dit bestandstype kan niet, kies een JPEG of een PNG bestand.";
    //     }
    //       if($file_size > 2097152){
    //         $errors[] ='Het bestand moet kleiner zijn dan 2 MB';
    //       }
    //     if(empty($errors)){
    //        // move_upload_file stuurt je bestand naar een andere locatie
    //        move_uploaded_file($file_tmp,"uploads/".$file_name);
    //        echo "Gelukt";
    // } else{ 
    //    print_r($errors);
    // }

if (isset($_FILES['image'])) {
    if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
        array_push($errors, 'File does not exist.');
    } else {
        $allowed = ['png', 'jpg', 'jpeg', 'gif'];
        $fileExt = explode(".", $_FILES['file']['name']);
        $fileActExt = strtolower(end($fileExt));
        if (!in_array($fileActExt, $allowed)) {
            array_push($errors, 'Unsupported file type.');
        } else {
            if ($_FILES['file']['size'] > 5097152) {
                array_push($errors, 'File size too large.');
            } else {
                $path = "../../assets/userfiles/imgs/".$_SESSION['id'].".webp";
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            }
        }
    }
}
?>
