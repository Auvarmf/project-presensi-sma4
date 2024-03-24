<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'image|file|max:1024',
        ];

        if ($this->isMethod('post')) {
            $rules += [
                'nip' => [
                    'required',
                    'string',
                    Rule::unique('users', 'nip')->ignore(optional($user)->id),
                ],
                'password' => 'required|string|min:8',
                'confirm_password' => 'required|string|same:password', // Perubahan disini
                'role'     => 'required|string|in:guru,siswa',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'                     => 'Nama harus diisi',
            'image.max'                         => 'Ukuran gambar terlalu besar, maksimal 1MB',
            'nip.unique'                        => 'NIP/NISN telah terdaftar',
            'nip.required'                      => 'NIP/NISN harus diisi',
            'role.required'                     => 'Role harus diisi',
            'password.required'                 => 'Kata sandi harus diisi',
            'password.min'                      => 'Kata sandi harus terdiri dari minimal 8 karakter',
            'confirm_password.same'             => 'Konfirmasi kata sandi harus sesuai'
        ];
    }
}
