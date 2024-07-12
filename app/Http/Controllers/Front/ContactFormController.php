<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactFormDatabase;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function submit(Request $request, $form_id, $name, $unique_id)
    {
        $formData = $request->except('_token');

        ContactFormDatabase::create([
            'form_id' => $form_id,
            'form_name' => $name,
            'form_unique_id' => $unique_id,
            'form_data' => json_encode($formData),
            'user_ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->back()->with('cf-success', 'Test');
    }
}
