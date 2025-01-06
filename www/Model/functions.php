<?php
function emailVerification(){
    if (!filter_var($_POST["form_email"], FILTER_VALIDATE_EMAIL)) {
        return "Adresse e-mail invalide.";
    }
    return "";
}