<?php

namespace App\Imports;

use App\Airline;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ContentImport implements ToModel, WithChunkReading, WithBatchInserts, WithStartRow
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
        $fillable = array('region', 'subregion', 'country', 'operator', 'primaryrole', 'status', 'serialno', 'registration', 'aircraftFamily', 'aircraftType', 'aircraftSeries', 'aircraftModel', 'engineType', 'engineModel', 'engineThrust', 'apuModel', 'buildYear', 'currentAge', 'owner', 'ownerManager', 'leaseManager', 'leaseType', 'sublessor', 'currentStatusTime', 'currentTSN', 'currentTSNDate', 'locationCountry');
        
        foreach($row as $key=>$value){
            if ($key < 27 ){
                $insert_data[$fillable[$key]] = $value;
            }
        }
        $results = Airline::where($insert_data)->get();
        if ( $results->isEmpty() ){
            return new Airline($insert_data);
        }
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
