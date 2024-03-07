<?php

$currentUrl = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$currentUrl);
// print_r($parts);
$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
$statusUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$parts[1].'/status.php?transactionid=';
$statusUrl .= $values[$key][4];

$myurl = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$myurl);
$directory = $parts[1];
$theUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$directory.'/';

$styledMessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

.ii p a[href] {
    color: #fff;
    text-decoration:none;
}
p > a:link {
  color:#fff!important;
}
table#cart th,table#cart td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
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
                      <td align="center" class="es-p20t" style="padding:0;Margin:0;padding-top:20px;"> <a href="http://antminerhub.com" target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"><img src="'.$theUrl.'images/logo.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="86"></a> </td> 
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
                      <td align="left" style="padding:0;Margin:0;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">Your payment has been received, thank you. Your order will now be shipped. <a href="'.$statusUrl.'"> Click here to review the details for your order.</a>
                     </td>
                     </tr>
                    </tbody> 
                   </table> </td> 
                 </tr> 
                </tbody> 
               </table> </td> 
             </tr> 
             <tr style="border-collapse:collapse;"> 
              <td class="es-p20" align="left" style="padding:20px;Margin:0;"> 
               <table id="cart" cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;"> 
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
                      <td align="left" style="padding:0;Margin:0;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:150%;color:rgb(51, 51, 51);">';
                        $imgUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$directory.'/images/';

                        $items = array();
                        foreach ($cart as $key => $value) {
                          array_push($items, $key);
                        }
                        $styledMessage .= '<table cellpadding="10" cellspacing="3" align="center" border="1" width="100%" style="text-align:center;">';
                        for ($i = 0; $i < count($items); $i++) {
                          $currentItem = $items[$i];
                          if ($currentItem != "total") {
                            if ($cart->$currentItem->qty > 0) {
                                $styledMessage .= '<tr><td><img src="'.$imgUrl.$currentItem.'.png" style="width:100px"/></td><td>'.$currentItem.'</td><td>'.$cart->$currentItem->qty.'</td><td>'.$cart->$currentItem->description.'</td><td>'.$cart->$currentItem->price.'</td>';
                            }
                          }
                        }
                      $styledMessage .= '</table></p></td> 
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
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="http://antminerhub.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"> <img class="adapt-img" src="'.$theUrl.'images/l3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="174"> </a> </td> 
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
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="http://antminerhub.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"> <img class="adapt-img" src="'.$theUrl.'images/l3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="173"> </a> </td> 
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
                      <td align="center" style="padding:0;Margin:0;"> <a target="_blank" href="http://antminerhub.com" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;text-decoration:underline;color:rgb(19, 118, 200);"> <img class="adapt-img" src="'.$theUrl.'images/l3.png" alt="" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" width="173"> </a> </td> 
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