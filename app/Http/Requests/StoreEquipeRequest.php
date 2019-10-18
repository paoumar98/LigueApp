<?php

namespace App\Http\Requests;

use App\Equipe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreEquipeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('equipe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'     => [
                'required',
            ],
            'logo'     => [
                'required',
            ],
            'division' => [
                'required',
            ],
        ];
    }
}
