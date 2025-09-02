<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function edit(Settings $settings)
    {
        return view('admin.settings', compact('settings'));
    }

    
    public function update(Request $request, Settings $settings)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'name' => 'required|max:255',
            'tagline' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',            
            'gst_number' => [
                'nullable',
                'string',
                'size:15',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9A-Z]{1}Z[0-9A-Z]{1}$/',
                Rule::unique('settings', 'gst_number')->ignore($settings->id),
            ],
            'address' => 'nullable|string|max:500',
            'location' => 'nullable|url|max:255',
            'contact_number' => 'nullable|string|max:20|regex:/^(?:\+91[-\s]?)?[6-9]\d{9}$/',
            'whatsapp_number' => 'nullable|string|max:20|regex:/^(?:\+91[-\s]?)?[6-9]\d{9}$/',
            'copyright' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',            
            'instagram' => 'nullable|url|max:255',                  
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'authorized_signatory' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);
    
        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                $oldPath = public_path('uploads/' . $settings->logo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
    
            $image = $request->file('logo');
            $image_name = uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $image_name);
            $validated['logo'] = $image_name;
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                $oldPath = public_path('uploads/' . $settings->favicon);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
    
            $image = $request->file('favicon');
            $image_name = uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $image_name);
            $validated['favicon'] = $image_name;
        }

        if ($request->hasFile('authorized_signatory')) {
            if ($settings->authorized_signatory) {
                $oldPath = public_path('uploads/' . $settings->authorized_signatory);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
    
            $image = $request->file('authorized_signatory');
            $image_name = uniqid() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $image_name);
            $validated['authorized_signatory'] = $image_name;
        }

        $settings->update($validated);
    
        
    return redirect()->route('settings.edit', $settings->id)->with('success', 'Settings Updated Successfully');
    }
    
}
