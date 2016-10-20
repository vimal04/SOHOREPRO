<html>
    <head>
        <title>Mail Send With Attachement</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .insert_form ul {
                list-style: none;
                width: 30%;
                margin: auto;
                border: 1px solid #e5e5e5;
                background: #fff;
                white-space: nowrap;
                box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
                -webkit-box-shadow: 0 2px 2px -1px rgba(0,0,0,.1);
                padding: 15px;
            }
            .insert_form ul li {
                padding: 5px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <?php
        error_reporting(0);
        if (isset($_POST['submit'])) {
            //The form has been submitted, prep a nice thank you message
            //$output = '<h1>Thanks for your file and message!</h1>';
            //Set the form flag to no display (cheap way!)
            $flags = 'style="display:none;"';

            //Deal with the email
            $to = $_POST['mail_id'];
            $subject = 'File Attached';

            $message = "Test Message with Attachement";
            $attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
            $filename = $_FILES['file']['name'];

            $boundary = md5(date('r', time()));

            $headers = "From: admin@sohorepro.com\r\nReply-To: admin@sohorepro.com";
            $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

            $message = "This is a multi-part message in MIME format.

--_1_$boundary
Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

--_2_$boundary
Content-Type: text/plain; charset=\"iso-8859-1\"
Content-Transfer-Encoding: 7bit

$message

--_2_$boundary--
--_1_$boundary
Content-Type: application/octet-stream; name=\"$filename\" 
Content-Transfer-Encoding: base64 
Content-Disposition: attachment 

$attachment
--_1_$boundary--";

            $mail = mail($to, $subject, $message, $headers);
            echo $mail ? "Mail sent" : "Mail failed";
        }
        ?>
        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" <?php echo $flags; ?>>
            <input type="hidden" name="mail_send" id="mail_send" value="1" />
            <div class="insert_form">
                <ul style="list-style: none;">
                    <li>
                        <label>Enter the Mailid</label>
                        <input class="text_box" type="email" name="mail_id" id="mail_id">
                    </li>                    
                    <li>
                        <label>Choose a File</label>
                        <input type="file" name="file" id="file">
                    </li>                  
                    <li><label>&nbsp;</label><input type="submit" name="submit" id="submit" value="send"></li>
                </ul>
            </div>
        </form>
    </body>
</html> 
