<?php 
namespace WI\Contact\Http\Controllers;
/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ContactController extends Controller
{
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//dc('new contact c');
		//dd(Config::get("wi.contact.message"));
		return view('contact::contact');
	}
}