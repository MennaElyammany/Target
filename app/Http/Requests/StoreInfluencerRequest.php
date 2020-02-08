<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreInfluencerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $influencer = Auth::user();
        if($influencer->instagram_id==null){
        return [
                'country_id'=> 'required',
                'category_id'=>'required',
                'youtube_url'=>
                     'regex:~
                     ^(?:https?://)?                           # Optional protocol
                      (?:www[.])?                              # Optional sub-domain
                      (?:youtube[.]com/) # Mandatory domain name (w/ query string in .com)
                       ~x',
                ];
            }
            else{
                return [
                    'country_id'=> 'required',
                    'category_id'=>'required',
                    'youtube_url'=>
                         'nullable|regex:~
                         ^(?:https?://)?                           # Optional protocol
                          (?:www[.])?                              # Optional sub-domain
                          (?:youtube[.]com/) # Mandatory domain name (w/ query string in .com)
                           ~x',
                    ];

                
            }
    }
}
