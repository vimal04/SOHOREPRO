<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Mail Attachment PHP Script Demo Page</title>
        <link rel="stylesheet" href="css/mail.css"/>

    </head>
    <body>
        <div class="title">
            <h1>Mail Demo Page</h1>
        </div>
        <div class="mail">
            <form action='mail.php' method='post' id='mailForm' enctype='multipart/form-data'>
                <table>
                    <tr>
                        <td class="label"> Name : </td>
                        <td><input type="text" id="name" name="name" class="form-input" placeholder='User Name'/>
                            <div id="invalid-name" class="error_msg"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"> E-mail : </td>
                        <td><input type="email" id="email" name="email" class="form-input" placeholder='E-Mail'/>
                            <div id="invalid-email" class="error_msg"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"> From E-mail : </td>
                        <td><input type="email" id="femail" name="femail" class="form-input" placeholder='From E-Mail'/>
                            <div id="invalid-femail" class="error_msg"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"> Subject : </td>
                        <td><input type="text" id="subject" name="subject" class="form-input" placeholder='Subject'/>
                            <div id="invalid-subject" class="error_msg"></div>
                        </td>
                    </tr>			 
                    <tr>
                        <td class="label"> Phone : </td>
                        <td><input type="tel" id="phone" name="phone" class="form-input" placeholder='Phone'/>
                            <div id="invalid-phone" class="error_msg"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"> Image : </td>
                        <td><input type="file" id="image" name="image" class="form-input" placeholder='Image'> <div id="invalid-image" class="error_msg"></div></td>

                    </tr>

                    <tr>
                        <td class="label"> Message : </td>
                        <td><textarea cols="27" rows="5" id="message" name="message" placeholder='Message' value=''></textarea><div id="invalid-message" class="error_msg"></td>

                    </tr>

                    <tr>
                        <td colspan="2"> <input type="submit" value="Send Mail!" id='submit_btn' name="submit_btn" class="submit_btn"/></td>
                    </tr>
                    <table>
                        </form>
                        </div>
                        <script src="js/jquery-1.9.1.min.js"></script>
                        <script src="js/jquery.validate.min.js"></script>
                        <script>
                            (function($) {
                                jQuery.validator.setDefaults({
                                    errorPlacement: function(error, element) {
                                        error.appendTo('#invalid-' + element.attr('id'));
                                    }
                                });
                                $("#mailForm").validate({
                                    rules: {
                                        name: {
                                            required: true,
                                            minlength: 3,
                                        },
                                        email: {
                                            required: true,
                                            email: true,
                                        },
                                        phone: {
                                            required: true,
                                            number: true,
                                            minlength: 10,
                                            maxlength: 11
                                        },
                                        image: "required",
                                        message: "required",
                                        femail: {
                                            required: true,
                                            email: true,
                                        },
                                        subject: {
                                            required: true,
                                        }
                                    },
                                    messages: {
                                        name: {
                                            required: "Please enter your name",
                                            minlength: "Please enter a valid name",
                                        },
                                        email: {
                                            required: "Please enter your email",
                                            minlength: "Please enter a valid email address",
                                        },
                                        phone: {
                                            required: "Please enter your phone number",
                                            minlength: "Please enter your valid phone number",
                                            maxlength: "Please enter your valid phone number"
                                        },
                                        image: "Please Choose your image",
                                        message: "Please enter your message",
                                        femail: {
                                            required: "Please enter your email",
                                            minlength: "Please enter a valid email address",
                                        },
                                        subject: {
                                            required: "Please enter your subject",
                                        }
                                    }
                                });
                            })($);
                        </script>


                        </body>
                        </html>