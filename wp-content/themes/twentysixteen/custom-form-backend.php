<?php

add_action('wp_ajax_set_form', 'set_form');    //execute when wp logged in
add_action('wp_ajax_nopriv_set_form', 'set_form'); //execute when logged out

function set_form()
{
	global $wpdb;

	if ($_POST['req_type'] == 'get_details') {

		$error_flag = 0;

		// Validation for name field ....................................................
		$name = ucwords(strtolower(strip_tags($_POST['name'])));

		if (trim($name) == "") {
			// Error (Name can't be empty)
			$error_flag = 1;
			echo json_encode(array("STATUS" => "error", "message" => "Name can't be empty!"));
			die;
		} else {

			if (strlen($name) > 25 || strlen($name) < 4) {
				// Error (Name should be between 4 and 25 characters)
				$error_flag = 1;
				echo json_encode(array("STATUS" => "error", "message" => "Name should be between 4 and 25 characters!"));
				die;
			} else {
				// check if name only contains letters, dot and whitespace
				if (!preg_match("/^[a-zA-Z. ]*$/", $name)) {
					// Error (Special Characters in name)
					$error_flag = 1;
					echo json_encode(array("STATUS" => "error", "message" => "Name can have only letters, dot and whitespace!"));
					die;
				}
			}
		}

		// Email validation ...............................................................
		$email = strtolower(strip_tags($_POST['email']));

		// Remove all illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		// Validate e-mail
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// Error (Email is invalid)
			$error_flag = 1;
			echo json_encode(array("STATUS" => "error", "message" => "Email is in an invalid format!"));
			die;
		}

		// .................................................................................


		$phone_number = strip_tags($_POST['phone_num']);

		if (strlen($phone_number) != 10) {
			// Error (Phone number should be 10 characters long)
			$error_flag = 1;
			echo json_encode(array("STATUS" => "error", "message" => "Phone number should be 10 characters long!"));
			die;
		}


		if (!$error_flag) {
			
			// User existence check and if in case user doesn't exist then insert one 

			$user_existence_query =  "SELECT * FROM custom_form_response WHERE email = '" . $email . "'";

			$resp = $wpdb->get_results($user_existence_query);

			if(count($resp)==0)
			{
				$generated_otp = generateNumericOTP(6); // Generate a random 6 digit OTP

				$insert_sql = $wpdb->insert(
					'custom_form_response',
					array(
						'name' => $name,
						'email' => $email,
						'phone_num' => $phone_number,
						'latest_otp' => $generated_otp,
					)
				);
	
				if ($insert_sql) {
	
					// Send mail to user with otp
					$email_resp = send_mail($name, $email, $generated_otp);
	
					if ($email_resp) {
						echo json_encode(array("STATUS" => "success", "message" => "User details inserted and OTP sent on mail!", "user" => $email, "fallback_verification" => base64_encode($generated_otp)));
						die;
					} else {
						echo json_encode(array("STATUS" => "warning", "message" => "User details inserted but OTP mail can't be sent !"));
						die;
					}
				} else {
					echo json_encode(array("STATUS" => "error", "message" => "User details couldn't be inserted!"));
					die;
				}
			}
			else
			{
				echo json_encode(array("STATUS" => "error", "message" => "User/Email already exists!"));
				die;
			}

			
		}
	} elseif ($_POST['req_type'] == 'verify_otp') {

		$otp = strip_tags($_POST['otp']);

		if (strlen($otp) != 6) {
			// Error (Phone number should be 10 characters long)
			echo json_encode(array("STATUS" => "error", "message" => "OTP should be 6 characters long!"));
			die;
		}

		$user_email = $_POST['associated_user'];

		$query =  "SELECT * FROM custom_form_response WHERE email = '" . $user_email . "'";

		$resp = $wpdb->get_results($query);

		$db_otp = $resp[0]->latest_otp;

		if($otp==$db_otp)
		{
			echo json_encode(array("STATUS" => "success", "message" => "OTP is valid! User Verified."));
			die;
		}
		else
		{
			echo json_encode(array("STATUS" => "error", "message" => "OTP mismatch! Enter a valid OTP."));
			die;
		}

	}

	die;
}

function generateNumericOTP($n)
{
	$generator = "1357902468";

	$result = "";

	for ($i = 1; $i <= $n; $i++) {
		$result .= substr($generator, (rand() % (strlen($generator))), 1);
	}

	return $result;
}

function my_enqueue()
{
	wp_enqueue_script('ajax-script', get_template_directory_uri() . '/js/main.js', array('jquery'));
	wp_localize_script('ajax-script', 'cpm_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'my_enqueue');

function themebs_enqueue_styles()
{

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('toastr', get_template_directory_uri() . '/css/toastr.min.css');

}
add_action('wp_enqueue_scripts', 'themebs_enqueue_styles');

function themebs_enqueue_scripts()
{
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'));
	wp_enqueue_script('toastr', get_template_directory_uri() . '/js/toastr.min.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'themebs_enqueue_scripts');

function send_mail($name, $recp_email, $otp)
{
	require 'vendor/autoload.php';

	$email = new \SendGrid\Mail\Mail();
	$email->setFrom("lakshay3697@gmail.com", "Lakshay Sharma");
	$email->setSubject("Your OTP for custom wordpress template module");
	$email->addTo($recp_email, ucwords($name));
	$email->addContent(
		"text/html",
		"<p> Hi " . ucwords($name) . ",</p><p>Your OTP for custom wordpress template module is :- </p><h4>" . $otp . "</h4>"
	);
	$sendgrid = new \SendGrid('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');

	try {
		$sendgrid->send($email);
		return 1;
	} catch (Exception $e) {
		return 0;
	}
}

?>