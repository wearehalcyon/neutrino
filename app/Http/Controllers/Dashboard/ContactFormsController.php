<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ContactFormsController extends Controller
{
    public function index()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-contact-forms', compact('routeName'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-contact-forms-add', compact('routeName'));
    }

    public function addSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'form_fields' => 'required'
        ]);

        $form = ContactForm::create([
            'name' => $request->name,
            'form_fields' => $request->form_fields,
        ]);

        return redirect()->route('dash.c-forms.edit', $form->id)->with('success', __('Form was created'));
    }
}
