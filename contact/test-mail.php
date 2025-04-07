<?php
$to = "9025061@student.zadkine.nl"; 
$subject = "Test Email";
$message = "Dit is een testbericht vanuit PHP";
$headers = "From: noreply@example.com";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ E-mail is succesvol verzonden!";
} else {
    echo "❌ FOUT: E-mail kon niet worden verzonden.";
}
?>
