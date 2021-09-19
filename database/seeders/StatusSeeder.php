<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\admin\SystemStatus;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //create default system status
       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Pending';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Processing';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Cancelled';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Delivered';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Publish';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Unpublish';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Active';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();

       $systemStatus = new SystemStatus;
       $systemStatus->status_name   =    'Inactive';
       $systemStatus->vendor_found  =     0;
       $systemStatus->user_found    =     0;
       $systemStatus->created_by    =     1;
       $systemStatus->status        =     1;
       $systemStatus->save();
        
    }
}
