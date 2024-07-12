<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormNotificator;
use App\Models\ContactForm;
use App\Models\ContactFormDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function submit(Request $request, $form_id, $name, $unique_id)
    {
        try {
            $formData = $request->except('_token');

            $message = ContactFormDatabase::create([
                'form_id' => $form_id,
                'form_name' => $name,
                'form_unique_id' => $unique_id,
                'form_data' => json_encode($formData),
                'user_ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent')
            ]);

            $form = ContactForm::find($form_id);

            $mailTitle = 'Received message from "' . $form->name . '" Contact Form';
            $mailText = 'You received mail from "<strong>' . $form->name . '</strong>" Contact Form.<br><strong>Form: </strong><a href="' . route('dash.c-forms.edit', $form->id) . '" target="_blank">' . $form->name . '</a><br><strong>Unique Message ID: </strong><a href="' . route('dash.c-forms-db.view', [$message->id, $message->form_unique_id]) . '" target="_blank">' . $message->form_unique_id . '</a><br><strong>Date: </strong>' . date('F d, Y', strtotime($message->created_at)) . ' at ' . date('H:i:s', strtotime($message->created_at));

            if (getOption('site_email')) {
                Mail::to(getOption('site_email'))->send(new ContactFormNotificator($mailTitle, $mailText));
            }

            return redirect()->back()->with('cf-success', 'OK!');
        } catch (\Exception $e) {
            return redirect()->back()->with('cf-error', $e);
        }
    }
}
