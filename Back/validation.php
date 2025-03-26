<?php
$uploaddir = __DIR__ . '/uploads/';
if (!is_dir($uploaddir)) {
    mkdir($uploaddir, 0777, true); 
}

$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

$message = '';
if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $message = "Le fichier est valide, et a été téléchargé avec succès.";
    } else {
        $message = "Erreur lors du déplacement du fichier téléchargé.";
    }
} else {
    switch ($_FILES['userfile']['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $message = "Le fichier dépasse la taille maximale autorisée.";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "Aucun fichier n'a été téléchargé.";
            break;
        default:
            $message = "Erreur inconnue.";
            break;
    }
}

echo "<script>alert('$message'); window.location.href = '../Front/index.html';</script>";
?>