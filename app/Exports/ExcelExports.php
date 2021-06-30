<?php

namespace App\Exports;

use App\CategoryProductModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Brand;
class ExcelExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryProductModel::all();
    }
    public function collection1()
    {
        return Brand::all();
    }

}
