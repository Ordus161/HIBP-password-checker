<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BreachesController;

class PasswordChecker extends Model
{
    use HasFactory;

static function checkPassword($id){
    $result = DB::select( "select hash FROM breaches WHERE id = '$id'");
    
     foreach($result as $hash => $arrValue){
      foreach($arrValue as $hash => $value){
        $hashed_pass = $value;
      }}
    $curl = curl_init();
    
    
    
    $sha_prefix = strtoupper(mb_substr($hashed_pass,0,5));
    $sha_postfix = strtoupper(mb_substr($hashed_pass,5));

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.pwnedpasswords.com/range/'. $sha_prefix,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $separator = "\r\n";

    $filtred_result = [];
  
    $hibp_list = explode($separator, $response);
    foreach($hibp_list as $hibp_hash )
    {
      $hibp_explist = explode(":", $hibp_hash);
      $filtred_result[$hibp_explist[0]] = $hibp_explist[1];
    };

    if($filtred_result[$sha_postfix]) {
      $pwnd_count = $filtred_result[$sha_postfix];
      echo 'Your password has been compromissed :'. $pwnd_count . ' times.';
    }
    else echo 'Your password is secured.';
    
    BreachesController::update($pwnd_count,$id);

    }
}


