<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Jobs\ProcessCheckPassword;

class LastPwndChecker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $need_to_check = [];
        $result = DB::select( "select id,last_check FROM breaches");
    
        foreach($result as $result_obj){
            if(strtotime($result_obj->last_check) < strtotime('1 day ago'))  
            $need_to_check[] = $result_obj->id;
        }
        foreach ($need_to_check as $id)
        {
            dispatch(new ProcessCheckPassword($id));
        }

    }
      
    
    
}
