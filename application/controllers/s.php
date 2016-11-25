
$message= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xxhtml1-strict.dtd"><html><head>
	<meta http-equiv="Content-type" content="text/html"; charset="utf-8"/></head><body';

$message .= '<p>Dear '. $this->session->userdata('nama') .' </p>';
$message .= 'Thanks for your participation On PBGF 2017, you can download your PDF file in this link, just click<strong><a href=" '.base_url().'master/person/download_pdf' .$id .' / '. $email_code .'">Click Here</a></strong>';
$message .= 'Thank you';
$message .= '<p>Enjoy your new journey</p>';
$message .= '</body'></html>';
