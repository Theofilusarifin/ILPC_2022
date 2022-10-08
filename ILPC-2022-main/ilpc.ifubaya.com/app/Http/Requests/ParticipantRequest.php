<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'=>'required',
            'kartu_pelajar'=>["required", "file", "max: 10000", "mimes:jpeg,jpg,png"],
            'kelas'=>'required',
            'telp_peserta'=>'required',
            'email'=>'required',
        ];
    }
}
