<?php
session_start();
include "../../../mail/Sendmail.php";

$file_name = null;
$supporting_nik = null;
$support_theme = $_POST["support_theme"];
$support_message = $_POST["support_message"];
if (empty($support_message)) {
    exit;
} else {
    if (isset($_SESSION["nik"])) {
        $supporting_nik = $_SESSION["nik"];
    } else {
        $supporting_nik = "Гость";
    }
}

if (!empty($_FILES['file_name']) && $_FILES['file_name']['error'] == UPLOAD_ERR_OK) {
    $file = $_FILES['file_name'];
    $file_name = $file['name'];
}
if ($file_name == null) {
    sendEmail("info@bestlancer.ru", $support_theme, "Ник-нейм: $supporting_nik, Сообщение: $support_message");
} else {
    $file_to_attach = $_FILES['file_name']['tmp_name'];
    $filename = $_FILES['file_name']['name'];
    sendEmail("info@bestlancer.ru", $support_theme, "Ник-нейм: $supporting_nik, Сообщение: " . $support_message, $file_to_attach, $filename);
}
?>