<?php

namespace Tests\Query;

use App\Http\Controllers\Controller;
use DB;

class QueryTesting extends Controller
{
    public function queryChartSummarry()
    {
        DB::enableQueryLog();

        $userLocationIds = DB::table('location_user')
            ->where('user_id', 4)
            ->pluck('location_id');

        $userLocationName = DB::table('locations')
            ->whereIn('id', $userLocationIds)
            ->pluck('location');

        //Log::info('User Location :', $userLocationName->toArray());

        $data = DB::table('tenant_data')
            ->whereIn('location', $userLocationName)
            ->get();

        $totalTenants = $data->count();
        $activeServices = $data->where('status', 'Active')->count();
        // Get query log
        $log = DB::getQueryLog();
        echo "Query get chart sumamry";
        dump("query: " . $log[0]['query']);
        dump("time: " . $log[0]['time'] / 1000);
    }

    public function queryGetAllTenantData()
    {
        DB::enableQueryLog();

        $data = DB::table('tenant_data')
            ->leftJoin('locations', 'tenant_data.locationId', '=', 'locations.id')
            ->select('tenant_data.*', 'locations.location as location')
            ->get();

        $log = DB::getQueryLog();
        echo "Query get all tenant data";

        dump("query: " . $log[0]['query']);
        dump("time: " . $log[0]['time'] / 1000);

    }

    public function queryGetTenantsData()
    {
        DB::enableQueryLog();

        $userLocationIds = DB::table('location_user')
            ->where('user_id', 4)
            ->pluck('location_id');

        //Log::info('User Location :', $userLocationName->toArray());

        $data = DB::table('tenant_data')
            ->leftJoin('locations', 'tenant_data.locationId', '=', 'locations.id')
            ->whereIn('tenant_data.locationId', $userLocationIds)
            ->select('tenant_data.*', 'locations.location as location')
            ->get();

        $log = DB::getQueryLog();
        echo "Query get tenant data based on building manager location";

        dump("query: " . $log[0]['query']);
        dump("time: " . $log[0]['time'] / 1000);

    }

    public function testQuery()
    {
        $this->queryGetAllTenantData();
        $this->queryGetTenantsData();
        $this->queryChartSummarry();
    }
}