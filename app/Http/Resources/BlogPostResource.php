<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale = 'en';
        $default = 'en';
        if(session()->get('locale')) $locale = session()->get('locale');
        return [
            'id' => $this->id,
            'title' => isset(json_decode($this->title)->$locale) && json_decode($this->title)->$locale != "" ? json_decode($this->title)->$locale : json_decode($this->title)->$default,
            'body' => isset(json_decode($this->body)->$locale) && json_decode($this->body)->$locale != ""? json_decode($this->body)->$locale : json_decode($this->body)->$default,
            'category' => $this->category
        ];
    }
}
