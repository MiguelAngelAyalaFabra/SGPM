<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Puedes aplicar lógica de autorización si la necesitas
    }

    public function rules(): array
    {
        return [
            'id_alumno' => 'required|exists:alumnos,id',
            'id_tipo_plan' => 'required|exists:tipo_planes,id',
            'id_tipo_jornada' => 'required|exists:tipo_jornadas,id',
            'fecha_matricula' => 'required|date',
            'id_tipo_descuento' => 'nullable|exists:tipo_descuentos,id',
            'dias' => 'required|array',
            'dias.*' => 'in:Lunes,Martes,Miércoles,Jueves,Viernes',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $diasSeleccionados = $this->input('dias', []);
            $tipoPlanId = $this->input('id_tipo_plan');

            $maxDias = match ((int)$tipoPlanId) {
                2 => 2, // 2 días a la semana
                3 => 3, // 3 días a la semana
                1 => 5, // Lunes a viernes
                default => 5,
            };

            if (count($diasSeleccionados) > $maxDias) {
                $validator->errors()->add('dias', "El plan seleccionado permite un máximo de $maxDias día(s).");
            }
        });
    }

    public function messages(): array
    {
        return [
            'id_alumno.required' => 'Debe seleccionar un alumno.',
            'id_tipo_plan.required' => 'Debe seleccionar un tipo de plan.',
            'id_tipo_jornada.required' => 'Debe seleccionar una jornada.',
            'fecha_matricula.required' => 'Debe ingresar una fecha de matrícula.',
            'dias.required' => 'Debe seleccionar al menos un día de asistencia.',
        ];
    }
}
