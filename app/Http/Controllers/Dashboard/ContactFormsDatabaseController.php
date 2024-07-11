<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactFormDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ContactFormsDatabaseController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $messages = ContactFormDatabase::orderBy('created_at', 'DESC')->paginate(20);
        $messagesCount = $messages->count();

        return view('dashboard.page-contact-forms-database', compact('routeName', 'messages', 'messagesCount'));
    }

    public function view($id, $uid)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $message = ContactFormDatabase::where([
            'id' => $id,
            'form_unique_id' => $uid
        ])->first();

        $formData = json_decode($message->form_data, TRUE);

        return view('dashboard.page-contact-forms-database-view', compact('routeName', 'message', 'formData'));
    }
}
