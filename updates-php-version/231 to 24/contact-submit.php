<?php //@skip-indexing ?>
<?php
require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . 'settings.php');

global $my_email;
$email_field = $_POST['email'];
$params_ignored = array('submit', 'timestamp');

$headers = "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $my_email\r\n";
$headers .= "Reply-To: $email_field\r\n";

$current_host = 'http://' . $_SERVER["HTTP_HOST"] . str_replace('/contact-submit.php', '', $_SERVER['REQUEST_URI']);
$email_subject = "New email from $current_host";
$email_message = "<html><head></head><body>";
$email_message .= "<p>You have just received an email from the <a href=\"$current_host\" target=\"_blank\">$current_host</a> address.</p>";
$email_message .= "<p>Please find below the data from the contact form:</p>";
$email_message .= "<div>";
foreach ($_POST as $key => $value) {
    if (!in_array($key, $params_ignored)) {
        $email_message .= "<p>";
        $email_message .= "<span><strong>" . htmlspecialchars($key) . "</strong></span><br>";
        $email_message .= "<span>" . htmlspecialchars($value) . "</span>";
        $email_message .= "</p>";
    }
}
$email_message .= "</div>";
$email_message .= "</body></html>";

$mail_status = mail($my_email, $email_subject, $email_message, $headers);
if ($mail_status) {
    header('HTTP/1.1 200 OK');
}else{
    header('HTTP/1.1 500 Internal Server Error');
}
