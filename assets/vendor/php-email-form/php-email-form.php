<?php
class PHP_Email_Form {

    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $ajax = false;
    public $smtp = null;

    private $messages = [];

    // Add a message to the email body
    public function add_message($message, $label) {
        $this->messages[] = "<strong>" . htmlspecialchars($label) . ":</strong> " . nl2br(htmlspecialchars($message));
    }

    // Send the email
    public function send() {
        // Construct the message body
        $this->message = implode("<br><br>", $this->messages);

        // Build the headers for the email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: " . $this->from_name . " <" . $this->from_email . ">" . "\r\n";
        $headers .= "Reply-To: " . $this->from_email . "\r\n";

        // If SMTP is configured, send the email using SMTP
        if ($this->smtp !== null) {
            // Use PHPMailer or any SMTP library here for more advanced email handling
            // For now, we will skip SMTP logic (for simplicity)
            return 'SMTP is not configured yet.';
        }

        // Send the email using PHP's mail() function
        $mail_sent = mail($this->to, $this->subject, $this->message, $headers);
        
        // Return success or failure message
        if ($mail_sent) {
            return 'success';
        } else {
            return 'error';
        }
    }
}
?>
