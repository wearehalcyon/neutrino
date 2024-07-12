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

        return view('dashboard.page-contact-forms-database', compact('routeName', 'messages'));
    }

    public function view($id, $uid)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $message = ContactFormDatabase::where([
            'id' => $id,
            'form_unique_id' => $uid
        ])->first();
        $message->read = 1;
        $message->save();

        if (!$message) {
            abort(404);
        }

        $formData = json_decode($message->form_data, TRUE);

        return view('dashboard.page-contact-forms-database-view', compact('routeName', 'message', 'formData'));
    }

    public function delete($id, $uid)
    {
        restrictAccess([4,5]);
        ContactFormDatabase::where([
            'id' => $id,
            'form_unique_id' => $uid
        ])->first()->delete();
        return redirect()->route('dash.c-forms-db')->with('success', __('Message was deleted successfully.'));
    }

    public function markUnread($id, $uid)
    {
        $message = ContactFormDatabase::where([
            'id' => $id,
            'form_unique_id' => $uid
        ])->first();
        $message->read = 0;
        $message->save();

        return redirect()->route('dash.c-forms-db')->with('success', __('Message was marked as unread successfully.'));
    }
}
