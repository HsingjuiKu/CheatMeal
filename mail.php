<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

//Create an instance; passing `true` enables exceptions


function emails_main($mail_type, $email_address, $body_type, $item_body = '')
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //调试模式输出
        $mail->CharSet = "UTF-8";                   //设定邮件编码
        $mail->isSMTP();                                            //使用STMP
        $mail->Host = 'smtp.qq.com';                     //SMTP服务器
        $mail->SMTPAuth = true;                                   //允许SMTP认证
        $mail->Username = '1921161678@qq.com';                     //SMTP用户名
        $mail->Password = 'qzxsuofyfduwcggj';                               //密码
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('1921161678@qq.com', 'CheatMeal');


        switch ($mail_type) {
            case 'single':
                send_emails_single($mail, $email_address);
                break;
            case 'multiple':
                send_emails_multiple($mail, $email_address);
                break;
        }

        // $mail->addAddress('haydengu98@gmail.com');     //Add a recipient
        // $mail->addAddress('xingrui.gu@outlook.com');               //Name is optional
        // $mail->addAddress("haydengu@sina.com");
        //    $mail->addReplyTo('info@example.com', 'Information');
        //    $mail->addCC('cc@example.com');
        //    $mail->addBCC('bcc@example.com');

        //    //Attachments
        //    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        switch ($body_type) {
            case 'body_registrations':
                body_registrations($mail);
                break;
            case 'body_successfully_bids':
                body_successfully_bids($mail);
                break;
            case 'body_new_highest_bid':
                body_new_highest_bid($mail);
                break;
            case 'body_finish_winner':
                body_finish_winner($mail);
                break;
            case 'body_finish_auctions':
                body_finish_auctions($mail);
                break;
            case 'body_recommendations':
                body_recommendations($mail, $item_body);
        }

        $mail->send();
        echo 'Message has been sent, send';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function send_emails_single($mail, $email_address)
{
    $mail->addAddress($email_address);
}


function send_emails_multiple($mail, $email_address_result)
{
    while ($rows = $email_address_result->fetch_assoc()) {
        $email_address = $rows['email_address'];
        $mail->addAddress($email_address);
    }
}


function body_registrations($mail)
{
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Successful Registration!!!';
    $mail->Body = 'Welcome to BidBurr. You have succesfully registered.';
    $mail->AltBody = 'Please use the broser';
}

function body_successfully_bids($mail)
{
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Successful Bid';
    $mail->Body = 'Test send to email <b>Get more money in Cheatmeal</b>';
    $mail->AltBody = 'Please use the broser';
}

function body_new_highest_bid($mail)
{
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Highest Bid!!!!!';
    $mail->Body = 'You have been outbid.We Got A New Highest Bid Now! Check on the Website!';
    $mail->AltBody = 'Please use the broser';
}

function body_finish_winner($mail)
{
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Congratulations! You Won the Auction';
    $mail->Body = 'Congratulations On Winning The Auction!!!
                   Check It In The Website!!!  ';
    $mail->AltBody = 'Please use the broser';
}

function body_finish_auctions($mail)
{
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Congratulations! Your Item Has Been Sold.';
    $mail->Body = 'Congratulations!!!  A Bidder Has Won Your Auction!!
                   Check It In Your Website!!! ';
    $mail->AltBody = 'Please use the broser';
}

function body_recommendations($mail, $item_body)
{
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recomendations!!!';
    $body_string = '';
    $mail->Body = 'Here Are Some Recommendatoins:' . $item_body;
    $mail->AltBody = 'Please use the broser';
}
// $mail_type = 'single';
// $mail_add  = 'rain.jwzhang@gmail.com';
// $body_type = 'body_registrations';
// emails_main($mail_type, $mail_add, $body_type);

// include_once('utilities.php');
// $emails = get_emails_by_items(8);
// var_dump($emails);
// $mail_type = "multiple";
// $body_type = 'body_new_highest_bid';
// emails_main($mail_type, $emails, $body_type);
