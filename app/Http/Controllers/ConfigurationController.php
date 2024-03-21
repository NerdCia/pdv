<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('components.configurations', compact('users', 'roles'));
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {
        $validated = $request->validate(
            [
                'company_name' => 'required|string|max:20',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'company_name.required' => 'O campo nome da empresa não pode está vazio.',
                'company_name.max' => 'O campo nome da empresa não deve ter mais de 20 caracteres.',
                'image.image' => 'O arquivo deve ser uma imagem.',
                'image.mimes' => 'O campo da imagem deve ser um arquivo do tipo: jpeg, png, jpg.',
            ]
        );



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
