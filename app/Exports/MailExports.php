<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use App\Email;
class MailExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Email::all();
    }

}










    