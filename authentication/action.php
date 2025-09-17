<?php
header('Content-Type: application/json');
/* header('x-powered-by : PHP/8.0.30'); */
$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : '';

include 'admin_class.php';

$crud = new Action();

if ($action === 'save_installation_data') {
	$installer = $crud->save_installation_data();

	if ($installer) {
		echo $installer;
	}
}

if ($action === 'login') {

	$login = $crud->login();

	if ($login) {
		echo $login;
	}
}

if ($action === 'logout') {
	$logout = $crud->logout();

	if ($logout) {
		echo $logout;
	}
}

// if ($action === 'register-form') {
// 	$registration = $crud->registration_form();
// 	if ($registration) {
// 		echo $registration;
// 	}
// }

if ($action === 'account-form') {
    //header('Content-Type: application/json');
    echo $crud->account_form();
    exit;
}


if ($action === 'verifying') {
	$learner = $crud->verifyingcode();

	if ($learner) {
		echo $learner;
	}
}

if ($action === 'sending_Code') {
	$test = $crud->send_verification_mail();
	if ($test) {
		echo $test;
	}
}

if ($action === 'get_book_details') {
	$test = $crud->get_books();
	if ($test) {
		echo $test;
	}
}

if ($action === 'add_new_book') {
	$test = $crud->add_new_book();
	if ($test) {
		echo $test;
	}
}

if ($action === 'get_all_books') {
	$test = $crud->get_book_data();
	if ($test) {
		echo $test;
	}
}

if($action === 'get_message'){
	$test = $crud->get_allInbox();
	if ($test) {
		echo $test;
	}
}

if($action === 'delete_inbox'){
	$test = $crud->delete_Inbox();
	if ($test) {
		echo $test;
	}
}

if($action === 'feedback'){
	$test = $crud->feedback();
	if ($test) {
		echo $test;
	}
}

if ($action === 'update_book') {
	$test = $crud->update_borrowed();
	if ($test) {
		echo $test;
	}
}

if ($action === 'update_bookFaculty') {
	$test = $crud->update_borrowedFaculty();
	if ($test) {
		echo $test;
	}
}



if($action === 'delete_book'){
	$test = $crud->remove_book();
	if($test){
		echo $test;
	}
}

if($action === 'borrow_book'){
	$test = $crud->update_borrowed();
	if($test){
		echo $test;
	}
}

if($action === 'get_user_data'){
	$test = $crud->get_user_data();
	if($test){
		echo $test;
	}
}

if($action === 'remove_user'){
	$test = $crud->remove_user_accounts();
	if($test){
		echo $test;
	}
}
