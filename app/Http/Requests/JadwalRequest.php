<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        // Konversi format waktu_mulai dan waktu_selesai ke format yang diharapkan (H:i)
        $this->merge([
            'waktu_mulai' => date('H:i', strtotime($this->waktu_mulai)),
            'waktu_selesai' => date('H:i', strtotime($this->waktu_selesai)),
        ]);
    }
    
    public function rules(): array
    {
        return [
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'id_kelas' => 'required|exists:kelas,id',
            'id_guru' => 'required|exists:users,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ];
    }

    public function messages()
    {
        return [
            'id_mapel.required' => 'Pilih mata pelajaran.',
            'id_mapel.exists' => 'Mata pelajaran yang dipilih tidak valid.',
            'id_kelas.required' => 'Pilih kelas.',
            'id_kelas.exists' => 'Kelas yang dipilih tidak valid.',
            'id_guru.required' => 'Pilih guru pengajar.',
            'id_guru.exists' => 'Guru pengajar yang dipilih tidak valid.',
            'hari.required' => 'Pilih hari jadwal.',
            'hari.in' => 'Hari jadwal harus Senin, Selasa, Rabu, Kamis, atau Jumat.',
            'waktu_mulai.required' => 'Masukkan waktu mulai.',
            'waktu_mulai.date_format' => 'Format waktu mulai tidak valid. Contoh: 08:00.',
            'waktu_selesai.required' => 'Masukkan waktu selesai.',
            'waktu_selesai.date_format' => 'Format waktu selesai tidak valid. Contoh: 09:00.',
            'waktu_selesai.after' => 'Waktu selesai harus setelah waktu mulai.',
        ];
    }
}
