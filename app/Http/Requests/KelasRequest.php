<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
    public function rules()
    {
        return [
            'jenjang_kelas' => 'required|in:X,XI,XII',
            'kategori_kelas' => 'required|string',
            'wali_kelas_id' => 'required|exists:users,id,role,guru',
        ];
    }

    public function messages()
    {
        return [
            'jenjang_kelas.required' => 'Jenjang kelas harus diisi.',
            'kategori_kelas.required' => 'Kategori kelas harus diisi.',
            'kategori_kelas.string' => 'Kategori kelas harus berupa teks.',
            'wali_kelas_id.required' => 'Wali kelas harus dipilih.',
            'wali_kelas_id.exists' => 'Wali kelas yang dipilih tidak valid.',
        ];
    }
}
