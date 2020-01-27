<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        return [
                'country_id'=> 'required',
                'category_id'=>'required',
                'youtube_url'=>
                     'regex:~
                     ^(?:https?://)?                           # Optional protocol
                      (?:www[.])?                              # Optional sub-domain
                      (?:youtube[.]com/channel/) # Mandatory domain name (w/ query string in .com)
                      ([^&]{24})                               # Video id of 11 characters as capture group 1
                       ~x',
                ];
    }
}
