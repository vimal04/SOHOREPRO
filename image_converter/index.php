<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--<img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("norton.png")); ?>">-->

        <?php
         $image = base64_encode(file_get_contents("norton.png"));
         //echo base64_decode($image);
         ?>
        <!--<img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("norton.png")); ?>" width="100px" height="100px" />-->
        <!--<img src="data:image/png;base64,<?php echo base64_encode(file_get_contents("norton.png")); ?>" width="100px" height="100px" />-->
         <?php
        $to = "mohamedjassim5@gmail.com";
        $subject = "HTML email";
       // header("Content-type: image/gif");
        $image = 'base64_encode(file_get_contents("norton.png"))';
        $message = "<html>
                    <head>
                    <title>HTML email</title>
                    </head>
                    <body>
                    <p>This email contains HTML Tags!</p>
                    <table>
                    <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    </tr>
                    <tr>
                    <td><img src='http://cipldev.com/supply-new.sohorepro.com/image_converter/norton.png' width='100px' height='100px' /></td>
                    <td>Doe</td>
                    </tr>
                    </table>
                    </body>
                    </html>";  

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n" ;
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";

        //echo $message;
        
        $result = mail($to, $subject, $message, $headers);
        
        if($result){
            echo 'Mail Sent';
        }  else {
            echo 'Mail Not Sent';
        }
        ?>


    </body>
</html>
