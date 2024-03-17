<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('components.configurations', compact('users'));
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $configurations = $request->all();

        if ($request->image) {
            $extension = $request->image->getClientOriginalExtension();
            $configurations['image'] = $request->image->storeAs(
                'logos',
                'logo.' . $extension,
            );

            $logo = Configuration::where('key', '=', 'logo')->first()->update([
                'value' => $configurations['image']
            ]);
        }

        $company_name = Configuration::where('key', '=', 'company_name')->first()->update([
            'value' => $request->company_name,
        ]);

        return redirect()->route('components.configurations');
    }
}
