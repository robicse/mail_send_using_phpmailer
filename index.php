<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Create PDF file and send mail</title>
		<link href="style.css" rel="stylesheet"/>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	</head>
	
	<body>
		<div class="container">	
			<div class="row col-sm-12 col-md-12 col-lg-12">
				<div class="modal-body">
					<p>Please fill in your details below.</p>
					<form action="" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
						<div class="form-group">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<input type="text" class="form-control" name="fullname" placeholder="Full Name">		
							</div>	
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<input type="text" class="form-control" name="email" placeholder="Email Address">		
							</div>	
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<input type="text" class="form-control" name="contactno" placeholder="Contact No">		
							</div>	
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<input type="text" class="form-control" name="gender" placeholder="Gender">		
							</div>	
						</div>
						<div class="form-group">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<input class="btn btn-success" type="submit" name="submit" value="Submit">
							</div>	
						</div>
					</form>
				</div>
			</div>
		</div>	
	</body>
</html>

<?php
	if(isset($_POST['submit'])){
		//echo 'ok';
		
		$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		$contactno=$_POST['contactno'];
		$gender=$_POST['gender'];
		
		
		$ticket_id=rand(1,3);
		//echo $ticket_id;exit;
		
		//$ticket_id= $data->id;
		//var_dump(strlen($ticket_id));exit;
		if(strlen($ticket_id) == 1){
			$ticket_id="000".$ticket_id;
		}else if(strlen($ticket_id) == 2){
			$ticket_id="00".$ticket_id;
		}else if(strlen($ticket_id) == 3){
			$ticket_id="0".$ticket_id;
		}
		
		
		
		//Start pdf Section
		require 'tcpdf/tcpdf.php';
		//require 'modules/tcpdf/tcpdf.php';
		
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Flower Fest');
		$pdf->SetTitle('Ticket Information');
		$pdf->SetSubject('Flower Fest Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, '', '', array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
		
		// Set some content to print
$a='aaaaa';
$html = <<<EOD
<div style="width:350px;border:1px solid grey">
<img src="images/event_ticket.jpg" style="width:350px;height:auto;"/><br>
Ticket No: $ticket_id<br>
Name: $fullname<br>
Email Address: $email<br>
Mobile No: $contactno<br>
Gender: $gender<br>
</div>
EOD;

		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.

		//echo __DIR__; echo '<br>'; 
		//$pdf->Output(__DIR__ .'/example_001.pdf', 'F');
		$pdf->Output(__DIR__ .'/attachment/example_001.pdf', 'F');
		//$_SERVER['DOCUMENT_ROOT'].url::base().'attachment/test.pdf'
		//$pdf->Output($_SERVER['DOCUMENT_ROOT'].url::base().'attachment/'.$ticket_id.'.pdf', 'F');
						 //$pdf->Output(DOCROOT.'attachment/'.$ticket_id.'.pdf', 'F');

		//============================================================+
		// END OF FILE
		//============================================================+

		// END PDF SECTION
		
		
		
		
		
		// echo getcwd();
		// mail sent process start 
		
		
		//require 'modules/PHPMailer/PHPMailerAutoload.php';
		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.zoho.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'registration@townclockbd.com';                 // SMTP username
		$mail->Password = 'windmill123';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('registration@townclockbd.com', 'TownclockBD');
		$mail->addAddress($email, $fullname);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('registration@townclockbd.com', 'TownclockBD');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		
		//$attachmentFile= $_SERVER['DOCUMENT_ROOT'].url::base()."attachment/".$ticket_id.".pdf";
						  //$attachmentFile= DOCROOT."attachment/".$ticket_id.".pdf";
						  $attachmentFile="attachment/".$ticket_id.".pdf";
		//echo $attachmentFile; exit;
		$mail->addAttachment($attachmentFile);         // Add attachments
		//$mail->addAttachment('D:/xampp/htdocs/townclock/attachment/test.pdf');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Ticket info on fashion show for the Bangladesh Flower Fest 2016';
		$mail->Body    = 'Greetings from Townclock!<br><br>Kindly find the attached ticket information regarding the fashion show Powered by <a href="deshiphool.com">deshiphool.com</a> for the Bangladesh Flower Fest 2016.<br><br>Regards,<br>Townclock<br>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			//echo 'Message has been sent';
			$err['Success']="Congratulations! You have successfully completed the registration process. We have sent the free e-ticket on your given email address. Please check your email";
		}
		
		
		// mail sent process end 

	}
?>