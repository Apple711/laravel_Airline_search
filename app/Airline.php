<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    //
    protected $fillable = ['region', 'subregion', 'country', 'operator', 'primaryrole', 'status', 'serialno', 'registration', 'aircraftFamily', 'aircraftType', 'aircraftSeries', 'aircraftModel', 'engineType', 'engineModel', 'engineThrust', 'apuModel', 'buildYear', 'currentAge', 'owner', 'ownerManager', 'leaseManager', 'leaseType', 'sublessor', 'currentStatusTime', 'currentTSN', 'currentTSNDate', 'locationCountry'];
}
