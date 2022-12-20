<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Exception;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    public function store(Request $request)
    {
        try{
            if (auth()->user()->id) {
               $longurl = $request->get('url');
               $newGeneratedUrl = $request->get('shortlink');

               if ($longurl != '' || $newGeneratedUrl != '') {
                    $urlFound = UrlShortener::where('old_url', $longurl)->get(['id','new_url'])->toArray();

                    if (!empty($urlFound)) {
                        return  $urlFound[0]['new_url'];
                    } else{
                          $urlTable = new UrlShortener;
                          $urlTable ->old_url = $longurl;
                          $urlTable ->new_url = $newGeneratedUrl;
                          $urlTable->user_id = auth()->user()->id;
                          $urlTable->user_ip = $_SERVER['REMOTE_ADDR'];
                         

                          if ( $urlTable->save()) {
                            return $urlTable->new_url;
                          }
                         
                    }
               }
            }
        }
        catch(Exception $e){
            dd($e);
        }
    }

    public function handle(Request $request, $url)
    {
        // return dd($request, $url);
        try{
            $uri = $_SERVER['REQUEST_URI'];

            if ($uri == '') {
                return abort(404);
            }

            $url = UrlShortener::where('new_url','like','%'.$uri.'%')->get('old_url');
            // return dd($url);
            $count =  count($url);
            if ( $url == '' || $count = 0) {
                return abort(404);
            }else{
                // dd($url[0]['old_url']);
                return redirect($url[0]['old_url']);
            }
        }catch(Exception $e){
            dd($e);
        }
    }
}
