<?php
    $configArray = parse_ini_file("config.ini");
    $inventorySheetId = $configArray["inventorySheetId"];
    $inventoryMacroId = $configArray["inventoryMacroId"];
    $ordersSheetId = $configArray["ordersSheetId"];
    $ordersMacroId = $configArray["ordersMacroId"];
    $apiKey = $configArray["apiKey"];
    $bitcoinWallet = $configArray["bitcoinWallet"];

  // ------------- BEGIN OF CUSTOMIZABLE INFO ------------------
  // email of the person receiving the contact form (your email)
  $to = 'pizza@gmail.com';
  // your site url (for info in the email)
  $site_url = 'http://antminerhub.com';
  $form_email_label = "Your email:";
  $form_message_label = "Your message:";
  $form_submit_label = "Send";
  $attack_detected = "Sending information to administrator";
  $missing_from =    "Please provide an email address";
  $invalid_from =    "Please provide a valid email address - like name@domain.com";
  $missing_message = "Please insert some text in the message";
  $could_not_send =  "There was a problem while sending the email. Please try again a bit later.";
  // ------------- END OF CUSTOMIZABLE INFO ------------------
  $from_errors = array();
  $message_errors = array();
  $sending_error = array();
  function cleanEmail($email) {
    return trim(strip_tags($email));
  }
  function validEmail($email) {
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    return preg_match($pattern, cleanEmail($email));
  }
  function verifyFrom($from){
    if(empty($from))       { array_push($from_errors, $missing_from); }
    if(!validEmail($from)) { array_push($from_errors, $invalid_from); }
    return count($from_errors) == 0;
  }
  function verifyMessage($message) {
    if(empty($message))    { array_push($message_errors, $missing_message); }
    return count($message_errors) == 0;
  }
  
function sendConfirmationEmail() {
    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);
    $depositAddress = $query["depositAddress"];
    $currency = $query["currency"];
    $sourceAddress = $query["sourceAddress"];

    $from = 'pizza@gmail.com';
    $adminMessage = 'Order ID: '. $_POST['orderId'] .'Name: '. $_POST['name'] .'<br/>Address: '. $_POST['address'] .'<br/>City: '. $_POST['city'] .'<br/>State: '. $_POST['state'] .'<br/>Country: '. $_POST['country'] .'<br/>Zip Code: '. $_POST['zip'] .'<br/>Email: '. $_POST['email'] .'<br/>Phone: '. $_POST['phone'] .'<br/>Message: '. $_POST['message'] .'<br/>Total: $'. $_POST['total'] .'<br/>Cart: '. $_POST['cart'] .'<br/>Currency: '. $_POST['pair'] .'<br/>Deposit Address: '. $_POST['depositAddress'] .'<br/>Deposit Amount: '. $_POST['depositAmount'];
        if (verifyFrom($from) && verifyMessage($message)) {
          $cleanFrom = cleanEmail($from);
          $subject = 'Contact - '. $site_url;
          $headers = "From: " . $cleanFrom . "\r\n";
          $headers .= "Reply-To: ". $cleanFrom . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $userEmail = $_POST['email'];
    $orderInfo = 'Order ID: '. $_POST['orderId'] .'<br/>Name: '. $_POST['name'] .'<br/>Address: '. $_POST['address'] .'<br/>City: '. $_POST['city'] .'<br/>State: '. $_POST['state'] .'<br/>Country: '. $_POST['country'] .'<br/>Zip Code: '. $_POST['zip'] .'<br/>Email: '. $_POST['email'] .'<br/>Phone: '. $_POST['phone'] .'<br/>Message: '. $_POST['message'] .'<br/>Total: $'. $_POST['total'] .'<br/>Currency: '. $_POST['pair'] .'<br/>Deposit Address: '. $_POST['depositAddress'] .'<br/>Deposit Amount: '. $_POST['depositAmount'];
    $confirmationMessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;">
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title></title> 
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <style>
@media only screen and (max-width: 600px) {p, ul li, ol li, a { font-size: 16px } h1 { font-size: 30px; text-align: center } h2 { font-size: 26px; text-align: center } h3 { font-size: 20px; text-align: center } h1 a { font-size: 30px } h2 a { font-size: 26px } h3 a { font-size: 20px } .es-menu td a { font-size: 16px !important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size: 16px } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size: 16 px } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size: 12px } *[class="gmail-fix"] { display: none !important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align: center !important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align: right !important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align: left !important } .es-m-txt-r a img, .es-m-txt-c a img, .es-m-txt-l a img { display: inline !important } .es-button-border { display: block !important } .es-button { font-size: 20px !important; display: block !important; border-width: 10px 0px 10px 0px !important } .es-btn-fw { border-width: 10px 0px !important; text-align: center !important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width: 100% !important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width: 100% !important; max-width: 600px !important } .es-adapt-td { display: block !important; width: 100% !important } .adapt-img { width: 100% !important; height: auto !important } .es-m-p0 { padding: 0px !important } .es-m-p0r { padding-right: 0px !important } .es-m-p0l { padding-left: 0px !important } .es-m-p0t { padding-top: 0px !important } .es-m-p0b { padding-bottom: 0 !important } .es-m-p20b { padding-bottom: 20px !important } .es-hidden { display: none !important } table.es-table-not-adapt, .esd-block-html table { width: auto !important } table.es-social { display: inline-block !important } table.es-social td { display: inline-block !important } }

</style> 
  <style>

#outlook a {
    padding: 0;
}
.ExternalClass {
    width: 100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height: 100%;
}
.es-button {
    mso-style-priority: 100 !important;
    text-decoration: none !important;
}
a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}
@-ms-viewport {
    width: device-width;
}
img + div {
   display:none;
}


</style> 
 </head> 
 <body style="width:100%;font-family:arial, "helvetica neue", helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;"> 
  <div class="es-wrapper-color" style="background-color:rgb(246, 246, 246);"> 
   <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" src="" color="#f6f6f6"></v:fill>
    </v:background>
<![endif]--> 
   <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;"> 
    <tbody> 
     <tr style="border-collapse:collapse;"> 
      <td valign="top" style="padding:0;Margin:0;"> 
       <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-header-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20b es-p20r es-p20l" align="left" bgcolor="#142745" style="padding:0;Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;background-color:rgb(20, 39, 69);"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-p20t" style="padding:0;Margin:0;padding-top:20px;"> <a href="http://antminerhub.com" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"><img src="http://158.69.206.102/ant-miner-hub/images/logo.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="86"></a> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:rgb(255, 255, 255);"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20" align="left" style="padding:20px;Margin:0;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" class="es-p15b" style="padding:0;Margin:0;padding-bottom:15px;"> <h2 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:rgb(51, 51, 51);">Thank you for your purchase!</h2></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">Your order has been received and once payment has been received at the specified address, we will ship out your rig(s). You can check your deposit status and order status in one convenient place by clicking the <a href="http://158.69.206.102/ant-miner-hub/status.php?transactionid='.$_POST['depositAddress'].'" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none !important;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:18px;color:rgb(255, 255, 255)!important;text-decoration:none;border-style:solid;border-color:rgb(30, 46, 79);border-width:10px 20px 10px 20px;display:inline-block;background:rgb(30, 46, 79);border-radius:30px;font-weight:normal;font-style:normal;line-height:120%;width:auto;text-align:center;">Check order status</a> button below. Email <a href="info@antminerhub.com">info@antminerhub.com</a> if you have any questions and we will promptly respond.</p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20" align="left" style="padding:20px;Margin:0;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" class="es-p15b" style="padding:0;Margin:0;padding-bottom:15px;"> <h2 style="Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:rgb(51, 51, 51);">Order Information:</h2></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">'.$orderInfo.'</p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-p10" style="padding:10px;Margin:0;"> <span class="es-button-border" style="border-style:solid;border-color:rgb(30, 46, 79);background:rgb(30, 46, 79);border-width:10px;display:inline-block;border-radius:30px;width:auto;color:#fff;"> <a href="http://158.69.206.102/ant-miner-hub/status.php?transactionid='.$_POST['depositAddress'].'" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none !important;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:18px;color:rgb(255, 255, 255);border-style:solid;border-color:rgb(30, 46, 79);border-width:10px 20px 10px 20px;display:inline-block;background:rgb(30, 46, 79);border-radius:30px;font-weight:normal;font-style:normal;line-height:120%;width:auto;text-align:center;">Check order status</a> </span> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20t es-p20r es-p20l" align="left" bgcolor="#f6f6f6" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:rgb(246, 246, 246);"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="left" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);"><br></p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:rgb(255, 255, 255);"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20t es-p20r es-p20l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">Check out some of our other mining rigs</p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:rgb(255, 255, 255);"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20t es-p20r es-p20l" align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;"> 
               <!--[if mso]><table width="560" cellpadding="0" 
                            cellspacing="0"><tr><td width="194" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="174" class="es-m-p0r es-m-p20b" align="center" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="http://antminerhub.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"> <img class="adapt-img" src="http://158.69.206.102/ant-miner-hub/images/l3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="174"> </a> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                  <td class="es-hidden" width="20" style="padding:0;Margin:0;"></td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="173" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="173" class="es-m-p20b" align="center" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="http://antminerhub.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"> <img class="adapt-img" src="http://158.69.206.102/ant-miner-hub/images/l3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="173"> </a> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="173" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="173" align="center" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="http://antminerhub.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"> <img class="adapt-img" src="http://158.69.206.102/ant-miner-hub/images/l3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="173"> </a> </td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20t es-p20b es-p20r es-p20l" align="left" style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;"> 
               <!--[if mso]><table width="560" cellpadding="0" 
                            cellspacing="0"><tr><td width="194" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="174" class="es-m-p0r es-m-p20b" align="center" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">Bitmain Antminer S9</p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                  <td class="es-hidden" width="20" style="padding:0;Margin:0;"></td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="173" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="173" class="es-m-p20b" align="center" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">Bitmain Antminer L3</p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td><td width="20"></td><td width="173" valign="top"><![endif]--> 
               <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="173" align="center" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">Bitmain Antminer D3</p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;"> 
        <tbody> 
         <tr style="border-collapse:collapse;"> 
          <td align="center" style="padding:0;Margin:0;"> 
           <table class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"> 
            <tbody> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p30t es-p30b es-p20r es-p20l" align="left" bgcolor="#142745" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;background-color:rgb(20, 39, 69);"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                <tbody> 
                 <tr style="border-collapse:collapse;"> 
                  <td width="560" align="center" valign="top" style="padding:0;Margin:0;"> 
                   <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
                    <tbody> 
                     <tr style="border-collapse:collapse;"> 
                      <td class="es-infoblock" align="center" style="padding:0;Margin:0;line-height:120%;font-size:12px;color:rgb(204, 204, 204);"> <a target="_blank" href="http://stripo.email/?utm_source=templates&amp;utm_medium=email&amp;utm_campaign=basic&amp;utm_content=training" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:12px;text-decoration:underline;color:rgb(204, 204, 204);"> <img src="images/2371521522619061.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="41"> </a> </td> 
                     </tr> 
                     <tr style="border-collapse:collapse;"> 
                      <td align="center" class="es-infoblock es-p15t" style="padding:0;Margin:0;padding-top:15px;line-height:120%;font-size:12px;color:rgb(204, 204, 204);"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:120%;color:rgb(204, 204, 204);">info@antminerhub.com</p></td> 
                     </tr> 
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
            </tbody> 
           </table> </td> 
         </tr> 
        </tbody> 
       </table> </td> 
     </tr> 
    </tbody> 
   </table> 
  </div>  
 </body>
</html>';
        if (verifyFrom($userEmail) && verifyMessage($confirmationMessage)) {
          $cleanUserEmail = cleanEmail($userEmail);
          $userSubject = 'Contact - '. $site_url;
          $userHeaders = "From: " . $cleanUserEmail . "\r\n";
          $userHeaders .= "Reply-To: ". $cleanUserEmail . "\r\n";
          $userHeaders .= "MIME-Version: 1.0\r\n";
          $userHeaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          //Ant Miner Hub Order Submissions
          echo '<script src="js/jquery.min.js"></script><script type="text/javascript">
            $.ajax({
            url: "https://script.google.com/macros/s/'.$ordersMacroId.'/exec",
            method: "GET",
            dataType: "json",
            data: {
                "orderId":"'. $_POST['orderId'] .'",
                "orderStatus":"new",
                "cart":'. json_encode($_POST['cart']) .',
                "total":"'. $_POST['total'] .'",
                "depositAddress":"'. $_POST['depositAddress'] .'",
                "depositAmount":"'. $_POST['depositAmount'] .'",
                "pair":"'. $_POST['pair'] .'",
                "name":"'. $_POST['name'] .'",
                "address":"'. $_POST['address'] .'",
                "city":"'. $_POST['city'] .'",
                "state":"'. $_POST['state'] .'",
                "country":"'. $_POST['country'] .'",
                "zip":"'. $_POST['zip'] .'",
                "email":"'. $_POST['email'] .'",
                "phone":"'. $_POST['phone'] .'",
                "timestamp": new Date().toUTCString()
            }
          }).success(function () {
            emptyCart();
            console.log("Order Received");
            setTimeout(function(){
                $("#completing_transaction").hide();
                $("#thanks").slideDown();
            }, 2000);
            });
            </script>';

            //Ant Miner Hub Inventory Updater
          // echo '<script src="js/jquery.min.js"></script><script type="text/javascript">
          //   $.ajax({
          //   url: "https://script.google.com/macros/s/AKfycbzNAOCuAwFp2YnS7lSc0fO6coLhihzgKV-f72jmOyWvWISNiBc/exec",
          //   method: "GET",
          //   dataType: "json",
          //   data: {
          //       "B2":s9Count,
          //       "B3":l3Count,
          //       "B4":d3Count
          //   }
          // }).success(
          //   //alert("inventory updated");
          //   );
          //   </script>';

          if (mail($to, $subject, $adminMessage, $headers) && mail($userEmail, $userSubject, $confirmationMessage, $userHeaders)) {
            echo '<script type="text/javascript">
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": "https://sheets.googleapis.com/v4/spreadsheets/'.$inventorySheetId.'/values/B2:B4?key='.$apiKey.'&majorDimension=ROWS",
                "method": "GET",
                "headers": {
                  "cache-control": "no-cache"
                }
              }
          
              $.ajax(settings).done(function (response) {
                var s9inventory = response.values[0][0];
                var l3inventory = response.values[1][0];
                var d3inventory = response.values[2][0];
                writeValues(s9inventory,l3inventory,d3inventory);
              });
              function writeValues(s9inventory,l3inventory,d3inventory) {
                var cart = '.$_POST['cart'].';
                s9inventory = s9inventory - parseInt(cart.s9.qty);
                l3inventory = l3inventory - parseInt(cart.l3.qty);
                d3inventory = d3inventory - parseInt(cart.d3.qty);
                var settings = {
                  "async": true,
                  "crossDomain": true,
                  "url": "https://script.google.com/macros/s/'.$inventoryMacroId.'/exec?B2="+s9inventory+"&B3="+l3inventory+"&B4="+d3inventory,
                  "method": "POST",
                  "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                  },
                  "data": {}
                }

                $.ajax(settings).done(function (response) {
                  console.log(response);
                });
                }
            </script>';
            //echo '<script></script>';
          } else {
            array_push($sending_errors, $could_not_send);
          }
          
        }
    }
  }

$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
if (!empty($_SERVER['QUERY_STRING'])) {
    if(!empty($query["withdrawal"])) {
        sendConfirmationEmail();
        //processCryptoPaymentChangelly();
    }
}
?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<title>Ant Miner Hub | Antminer ASIC Miners. Fast Shipping.</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/slick.css">
<link rel="stylesheet" type="text/css" href="css/style-darkblue.css">
</head>
<style>
.form-title {
    color: #756de7;
    font-weight: 300;
    font-size: 19px;
    margin: 30px auto;
    text-align: left;
    max-width: 980px;
}
ul.exchange-rates {
    text-align:center;
    margin:30px 0;
}
ul.exchange-rates li{
    list-style-type:none;
    display:inline;
    padding: 30px 20px 10px;
    border: 1px solid #142745;
    border-radius:10px;
    font-weight: bold;
    color:#142745;
    cursor:pointer;
}
/* ul.exchange-rates li:before{
    content:"|";
    position:absolute;
    margin-left: -20px;
} */
/*ul.exchange-rates li:first-of-type:before{
    content:"";
}*/
#exchange-container {
    text-align:center;
}
.currency-container {
    background: #142745;
    color: #fff;
    padding: 20px 20px 30px;
    border: 4px solid white;
    cursor:pointer;
}
.currency-container:nth-of-type(7) {
    background:#081730;
}
.currency-container:nth-of-type(6) {
    background:#142745;
}
.currency-container:nth-of-type(5) {
    background:#2B4060;
}
.currency-container:nth-of-type(4) {
    background:#344C72;
}
.currency-container:nth-of-type(3) {
    background:#52709E;
}
.currency-container:nth-of-type(2) {
    background:#6D8DBC;
}
.currency-container:nth-of-type(1) {
    background:#93acd3;
}
.currency-container div:before{
    content:"$";
}
@media (min-width: 768px) {
    .currency-container {
        width: 14.25%;
    }
}
#ifeatures.sfeatures {
    padding: 100px 0;
}
.spinner {
  width: 40px;
  height: 40px;

  position: relative;
  margin: 100px auto;
}

.double-bounce1, .double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #333;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  
  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
  animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

@-webkit-keyframes sk-bounce {
  0%, 100% { -webkit-transform: scale(0.0) }
  50% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bounce {
  0%, 100% { 
    transform: scale(0.0);
    -webkit-transform: scale(0.0);
  } 50% { 
    transform: scale(1.0);
    -webkit-transform: scale(1.0);
  }
}
</style>
<style>
#cart-container .htfy-pricing-table-holder .htfy-table .row.trow:before, #cart-container .htfy-pricing-table-holder .htfy-table .row .td {
    height: 140px;
    line-height:72px;
}
#cart-container .htfy-pricing-table-holder .htfy-table {
    max-width: 980px;
    min-width:450px;
    margin-left:auto;
    margin-right:auto;
}
#total-price::before {
    content:"$";
    position:absolute;
    margin-left:-10px;
}
.register-button {
    cursor:pointer;
}
</style>
<style>
    .crypto-accepted {
        display:inline-block;
        background:#fff;
        font-weight: bold;
        padding:10px 12px 5px 12px;
        -webkit-border-radius:50px;
        border-radius:50px;
    }
    .crypto-dropdown {
        width:250px;
        padding:0 20px;
        text-align:center;
        line-height:48px;
    }
    .price-title {
        text-decoration: line-through;
    }
    .email {
        white-space:nowrap;
    }
    #header-holder .bg-animation {
        height:135%;
        -webkit-transform: skewY(-2deg);
        transform: skewY(-2deg);
    }
    .cart {
        font-size: 1.5em;
        position: fixed;
        bottom:0;
        right: 0;
        overflow: hidden;
        height: 64px;
        padding: 0 1.195em;
        cursor: pointer;
        color: #abacae;
        border: none;
        background-color: transparent;
    }
    .text-hidden {
        position: absolute;
        top: 200%;
    }
    .cart__count {
        font-size: 9px;
        font-weight: bold;
        line-height: 15px;
        position: absolute;
        top: 50%;
        right: 20px;
        width: 15px;
        height: 15px;
        margin: -16px 0 0 0;
        text-align: center;
        color: #fff;
        border-radius: 50%;
        background: #5c5edc;
    }
    #view-hardware .support-button {
        background-color: #274679;
    }
    #view-hardware .support-button:hover {
        background-color: #3c66ac!important;
        text-decoration:none;
    }
    .pricing-info {
        font-style:italic;
    }
    .pricing-information {
        text-align:left;
        font-size:12px;
        margin-top:20px;
        line-height:20px;
        overflow-y: auto;
        height: 280px;
    }
    .pricing-content img, .pricing-title {
        cursor:pointer;
    }
    .pricing-box {
        margin-top: 20px;
    }
    #pricing {
        padding-top:40px;
    }
    .row-title {
        font-size:30px;
        font-weight:bold;
    }
    .row-title:after {
        display:none;
    }
    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #ffffff;
    }

    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #ffffff;
    }

    ::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(255,255,255,.3);
        background-color: #d6e0f5;
    }
    #quote-amount {
        display:none;
    }
</style>
<body>

<div id="header-holder" class="inner-header">
    <div class="bg-animation"></div>
    <?php include('header.php') ?>
    <div id="page-head" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="page-title" class="page-title">Review Order</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="top-container" class="container-fluid" style="max-width:1010px;">
</div>
<?php
$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
if (!empty($_SERVER['QUERY_STRING'])) {
    if(!empty($query["ordercomplete"])) {
        echo '
<div id="ifeatures" class="container-fluid sfeatures">
    <div class="container">
        <div id="completing_transaction" class="col-md-12">
            <div class="row-title grey-color">Completing transaction...</div>
            <p>Please wait a moment.</p>
            <div class="spinner">
              <div class="double-bounce1"></div>
              <div class="double-bounce2"></div>
            </div>
        </div>
        <div id="thanks" class="col-md-12" style="display:none;">
            <div class="row-title grey-color">Thanks for your order!</div>
            <p>You will receive an email confirmation for your order shortly.</p>
            <a href="index.php" class="ybtn ybtn-blue ybtn-shadow">Continue Shopping</a>
        </div>
    </div>
</div><script>document.getElementById("application-form").style.display = "none";document.getElementById("cart-container").style.display = "none";document.getElementById("page-title").innerText = "Order Complete";</script>';
    }
}
?>
<?php include('footer.php') ?>
<script src="js/jquery.min.js"></script>
<script>

</script>
</body>
</html>
