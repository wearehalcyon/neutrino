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

        $forms = ContactForm::orderBy('created_at', 'DESC')->paginate(20);

        return view('dashboard.page-contact-forms', compact('routeName', 'forms'));
    }

    public function add()
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        return view('dashboard.page-contact-forms-add', compact('routeName'));
    }

    public function addSave(Request $request)
    {
        restrictAccess([4,5]);

        $request->validate([
            'name' => 'required',
            'form_fields' => 'required'
        ]);

        $form = ContactForm::create([
            'name' => $request->name,
            'form_fields' => $request->form_fields,
        ]);

        return redirect()->route('dash.c-forms.edit', $form->id)->with('success', __('Form was created successfully.'));
    }

    public function edit($id)
    {
        restrictAccess([4,5]);

        $routeName = Route::currentRouteName();

        $form = ContactForm::find($id);

        return view('dashboard.page-contact-forms-edit', compact('routeName', 'form'));
    }

    public function editSave(Request $request, $id)
    {
        restrictAccess([4,5]);

        $request->validate([
            'name' => 'required',
            'form_fields' => 'required'
        ]);

        $form = ContactForm::find($id);
        $form->name = $request->name;
        $form->form_fields = $request->form_fields;
        $form->save();

        return redirect()->back()->with('success', __('Form was created successfully.'));
    }
}
