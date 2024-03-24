<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MataPelajaranRequest extends FormRequest
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
        $matapelajaran = $this->route('matapelajaran');

        return [
            'nama_mapel'   => 'required|string',
            'kode_mapel'   => ['required','string',Rule::unique('mata_pelajaran', 'kode_mapel')->ignore(optional($matapelajaran)->id)],
        ];
    }

    public function messages()
    {
        return [
            'nama_mapel.required'  => 'Mata pelajaran harus diisi',
            'kode_mapel.required'  => 'Kode mata pelajaran harus diisi',
            'kode_mk.unique'    => 'Kode mata pelajaran sudah terdaftar'
        ];
    }
}
