<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;


use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{

    private $extraColumn;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //
    }
//    public function __construct($extraColumn)
//    {
//        $this->extraColumn = $extraColumn;
//    }


    public function model(array $row)
    {

        return new Contact([
//            "company_id" => $this->extraColumn,
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email']
        ]);

    }
}
