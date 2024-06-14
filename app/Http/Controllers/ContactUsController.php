<?php namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\News;
use App\Models\Offices;
use App\Models\Pages;
use App\Models\Projects;
use App\Models\Settings;
use App\Models\Videos;
use App\Models\Widgets;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactUs;

class ContactUsController extends Controller
{
public function index()
{
$data['files'] = Files::getFiles();
$data['pages'] = Pages::getPages();
$data['settings'] = Settings::getSettings();
$data['offices'] = Offices::getOffices();
$data['widgets'] = Widgets::getWidgets();
$data['videos'] = Videos::getVideos();
return view('web.contactus', $data);
}

public function send(Request $request)
{
$v = Validator::make($request->all(), [
'g-recaptcha-response' => 'required|recaptcha'
], ['required' => ':attribute is required.'], [
'g-recaptcha-response' => 'Captcha'
]);

$this->validate($request, [
'name' => 'required',
'subject' => 'required',
'email' => 'required|email',
'description' => 'required',
'g-recaptcha-response' => 'required|recaptcha'
], ['required' => ':attribute is required.'], [
'g-recaptcha-response' => 'Captcha'
]);

$data = array(
'name' => $request->name,
'subject' => $request->subject,
'email' => $request->email,
'description' => $request->description
);

$alias = 'contact-us-email';
$mail = Settings::getSetting($alias);

Mail::to($mail)->send(new ContactUs($data));
return back()->with('success', 'Thanks for contacting us!');
}
}