<?php

namespace App\model;
use DB;
use Cookie;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Appfiles\Common\Functions;
use Mail;
use PDF;
use App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Model\Mail_settings;
use App\Model\View;
use App\Model\CustomPayment;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use URL;

class Common extends Model
{
    //
   public function __construct() 
   {   
        
   
      
     }

    public function setcity_ipaddress($ipaddress)
    {
       $city = $this->iplocation($ipaddress);
       $setcokkies = $this->setcokkies('usercity',$city);
       return $city;

    }

     public function setcokkies($name, $value, $minutes = false)
     {
        $cookie='';
        $getcokkies = $this->getcokkies($name);
        if($getcokkies!=false)
        {
            $forget = $this->deletecokkies($name);
            $setcookie =Cookie::queue($name, $value, $minutes);
            $cookie=$value;
            //print_r($cookie);
        }
        else
        {
            $setcookie =Cookie::queue($name, $value, $minutes);
            $cookie=$value;
        }
       // print_r($cookie);exit;
        return $cookie;
     }

     public function getcokkies($cookiename , $option = false)
     {
      
        $cookieValue = Cookie::get($cookiename);
        return $cookieValue;
     }
     public function deletecokkies($cookiesname)
     {
        $cookieValue = Cookie::forget($cookiesname);
        //print_r($cookieValue);
        //$cookieVale = Cookie::get($cookiesname);
        //print_r($cookieVale);
         return $cookieValue;
     }
     /* remove special charcter for string*/

    public function cleanURL($string) 
    {
     $string = str_replace(' ', '-', trim($string)); // Replaces all spaces with hyphens.
     $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string); // Removes special chars.

      return preg_replace('/-+/', '-', strtolower($string)); // Replaces multiple hyphens with single one.
    }


      /* calculate distnace bases of latitude and langitude*/
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);
      if ($unit == "K") 
      {
        return ($miles * 1.609344);
      } 
      else if ($unit == "N") 
      {
          return ($miles * 0.8684);
      } 
      else
      {
         return $miles;
      }
    }

      public function googleMapLink($getAddress, $getCity,$getState)
      {
        $destinationAddy = '&daddr='.urlencode($getAddress.' '.$getCity.' '.$getState);
        $startfrom = '&saddr=';
        return htmlentities("http://maps.google.com/maps?f=q&amp;hl=en&amp;{$startfrom}{$destinationAddy}");
      }

    public function iplocation($ip)
    {
      //$ip = $_SERVER['REMOTE_ADDR'];
     // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
      //print_r($details);
      //return $details->city;
       return 'India';
    }




  public function urlwithoutoperator($string) 
  {
   $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
  }

   public function makeviewcount($viewid,$viewtype)
   {
        session_start();
        $conditionCheck = array('view_id'=>$viewid,
                                'type'=>$viewtype,
                                'viewed_by_user_id'=>session_id());  
              $checkView =  View::where($conditionCheck)->orderBy('created_at','desc')->first();
              //$usercity = $commonObj->iplocation('182.64.161.94');
              if(empty($checkView))
              {
                  $Events_view_detail =new View();
                  $Events_view_detail->view_id = $viewid;
                  $Events_view_detail->ip_address = $_SERVER['REMOTE_ADDR'];
                  $Events_view_detail->type = $viewtype;
                  $Events_view_detail->viewed_by_user_id = session_id();
                  $Events_view_detail->save();
                  return true;
                  // }
              }
   }

       public function eventviewcounter($viewid,$viewtype)
     {
          session_start();
          $conditionCheck = array('view_id'=>$viewid,
                                  'type'=>$viewtype,
                                  'viewed_by_user_id'=>session_id());  
          $checkView =  View::where($conditionCheck)->orderBy('created_at','desc')->first();
          if(empty($checkView))
          {
              $Events_view_detail =new View();
              $Events_view_detail->view_id = $viewid;
              $Events_view_detail->ip_address = $_SERVER['REMOTE_ADDR'];
              $Events_view_detail->type = $viewtype;
              $Events_view_detail->viewed_by_user_id = session_id();
              $Events_view_detail->save();
              // }
          }
          $conditionCheck = array('view_id'=>$viewid,
                                  'type'=>$viewtype);  
          $checkViewall =  View::where($conditionCheck)->orderBy('created_at','desc')->get();
          $return['status'] = 'success';
          $return['total_view'] = count($checkViewall);
          return $return;
     }

    public function sendmail($mailmessage,$dataArray)
    {
            Mail::send('emails.welcome',array('user_message' => $mailmessage), function($message) use ($dataArray)
                {
                $message->from('noreply@hiremedev.slugcorner.com','HireMe');
                $message->to($dataArray['to'], $dataArray['name'])->bcc('support@hiremedev.slugcorner.com','HireMe')->subject($dataArray['subject']);
                if(isset($dataArray['file']) && count($dataArray['file'])>0 && $dataArray['file']!='')
                {
                  foreach($dataArray['file'] as $key=>$val)
                  {
                   $exp=explode('.', $key);
                   $extension=end($exp);
                   if($extension=='pdf')
                    {
                       $pos = strpos($val,$_ENV['CF_LINK']);
                        if ($pos !== false)
                        {
                          $message->attach($val);
                        }
                        else
                        {
                          $message->attachData($val, $key);
                        }

                    }
                    else
                    {
                       $message->attach($val);

                    }
                  }
                }
                });
    }


    
    
    function getFacesharecount($url)
    {
        $shares=0;
          $rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=".urlencode($url);
          $json = json_decode(file_get_contents($rest_url),true);
          if($json)
          {
            $shares = $json[0]['share_count'];
          }
        return $shares;
    } 
    function gettwittersharecount($url)
    {
        $shares=0;
        $source_url = $url;
        $rest_url = "https://api.twitter.com/1.1/search/tweets.json?url=".urlencode($source_url);
        $json = json_decode(file_get_contents($rest_url),true);
        if($json)
        {
          $shares = $json['count'];
        }
        return $shares;
    } 
    function getpinterestsharecount($url)
    {
        $shares=0;
        $json = file_get_contents( "http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=".$url);
        $json = substr( $json, 13, -1);
        if($json)
        {
          $ajsn = json_decode($json, true);
          $shares = $ajsn['count'];
        }
        return $shares;
    } 

    public function getPlus1($url)
    {
      $shares=0;
     
      $html =  file_get_contents( "https://plusone.google.com/_/+1/fastbutton?url=".urlencode($url));
      $doc = new \DOMDocument(); 
      libxml_use_internal_errors(true);
      $doc->loadHTML($html);
      libxml_clear_errors(); 
      $counter=$doc->getElementById('aggregateCount');
      if($counter)
      {
         $shares = $counter->nodeValue;
      }
      return $shares;
    }
    public function gettotalsharecounter($url)
    {
       $fbcount = $this->getFacesharecount($url);
       $twittercount =0;
       $pintrest = $this->getpinterestsharecount($url);
       $getPlus1 = $this->getPlus1($url);
       return $fbcount+$twittercount+$pintrest+$getPlus1;
       //return 0;
    }




     public function removefromurl($url,$toRemove)
     {
       $parsed = [];
       parse_str(substr($url, strpos($url, '?') + 1), $parsed);
       $removed = $parsed[$toRemove];
       unset($parsed[$toRemove]);
       $url = '';
       if(!empty($parsed))
       {
          $url=  http_build_query($parsed);
       }
       return $url;
     }

     public function getLatLong($address)
     {
      if(!empty($address))
      {
          //Formatted address
          $formattedAddr = str_replace(' ','+',$address);
          //Send request and receive json data by address
          $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
          $output = json_decode($geocodeFromAddr);
          //Get latitude and longitute from json data
          $data['latitude']  = $output->results[0]->geometry->location->lat; 
          $data['longitude'] = $output->results[0]->geometry->location->lng;
          //Return latitude and longitude of the given address
          if(!empty($data))
          {
              return $data;
          }else
          {
              return false;
          }
      }
      else
      {
        return false;   
      }
}

function getLocationInfoByIp($ip_addr)
{
    $return_data  = array('country'=>'', 'city'=>'','state'=>'');
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip_addr));
    // print_r($ip_data);
    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $return_data['country'] = $ip_data->geoplugin_countryName;
        $return_data['state'] = $this->transliterateString($ip_data->geoplugin_region);
        $return_data['city'] = $ip_data->geoplugin_city;
    }
    return $return_data;
}

function getuserlocation($ip_addr)
{
  $return_data  = array('country'=>'', 'city'=>'','state'=>'');
  $location =$this->getLocationInfoByIp($ip_addr);
  if($location['country']!='')
  {
    $condition = "country like '".$location['country']."'";
    $checkcountry = Country::whereRaw($condition)->first();
    if(!$checkcountry)
    {

      $contyrArray = array('country'=>$location['country'],'created_at'=>date('Y-m-d H:i:s'));
      $create = Country::insertGetId($contyrArray);
      $return_data['country'] = $create;
      ///////// make state enter/////
      if($location['state']!='')
      {
        $stateArray = array('state'=>htmlentities($location['state']),'country_id'=>$create,'created_at'=>date('Y-m-d H:i:s'));
        $createstate = State::insertGetId($stateArray);
         $return_data['state'] = $createstate;
      }
      //////////make city entry/////
      if($location['city']!='')
      {
        $cityarray = array('city'=>$location['city'],'state'=>$createstate,'country_id'=>$create,'created_at'=>date('Y-m-d H:i:s'));
        $createcity = City::insertGetId($contyrArray);
        $return_data['city'] = $createcity;
      }

    }
    else
    {
        $return_data['country'] = $checkcountry->id;
        if($location['state']!='')
        {
          $condition = "state like '".htmlentities($location['state'])."'";
          $checkstate = State::whereRaw($condition)->first();
          if(!$checkstate)
          {
            $stateArray = array('state'=>htmlentities($location['state']),'country_id'=>$checkcountry->id,'created_at'=>date('Y-m-d H:i:s'));
            $createstate = State::insertGetId($stateArray);
            $return_data['state'] = $createstate;
            //////////make city entry/////
            if($location['city']!='')
            {
              $cityarray = array('city'=>$location['city'],'state'=>$createstate,'country_id'=>$checkcountry->id,'created_at'=>date('Y-m-d H:i:s'));
              $createcity = City::insertGetId($cityarray);
              $return_data['city'] = $createcity;
            }

          }
          else
          {
            $return_data['state'] = $checkstate->id;
            if($location['city']!='')
            {
              $condition = "city like '".$location['city']."'";
              $checkcity = city::whereRaw($condition)->first();
              if(!$checkcity)
              {
                $cityarray = array('city'=>$location['city'],'state'=>$checkstate->id,'country_id'=>$checkcountry->id,'created_at'=>date('Y-m-d H:i:s'));
                $createcity = City::insertGetId($cityarray);
                 $return_data['city'] = $createcity;
              }
              else
              {
                $return_data['city'] = $checkcity->id;

              }
            }
          }
        }
    }
  }

  return $return_data;

}
 function transliterateString($txt) {
    $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
    return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
}

    

}
