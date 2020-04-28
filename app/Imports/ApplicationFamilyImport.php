<?php

namespace App\Imports;

use App\Appfamily;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ApplicationFamilyImport implements ToModel, WithChunkReading, WithBatchInserts, WithStartRow
{
    public function __construct(){
        ini_set('max_execution_time', 9999999999999);
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $fillable = array('productid', 'appfamily');
        
        foreach($row as $key=>$value){
            if ( $key == 9 && $pre_value != $value ){
                $insert_data['productid'] = 18;
                $insert_data['appfamily'] = $value;
            }
            $pre_value = $value;
        }
        
        return new Appfamily($insert_data);
        
    }
    public function chunkSize(): int
    {
        return 500;
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function startRow(): int 
    {
        return 2;
    }
}
