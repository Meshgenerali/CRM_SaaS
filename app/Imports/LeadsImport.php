<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lead([
           'business_id' => session('businessId'),
           'name' => $row['name'],
           'email' => $row['email'],
           'phone' => $row['phone'],
          // 'status' => $row['status'],
           'message' => $row['message']
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'nullable|max:15',
            'status' => 'required|in:new,contacted,converted',
            'message' => 'nullable|string',
        ];
    }
}
