<?php

namespace Mrba\LaraHper\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone'=>$this->phone,
            'username'=>$this->username,
            'email'=>$this->email,
            'gender' => $this->gender,
            'country' => $this->country,
            'province' => $this->province,
            'city' => $this->city,
            'avatar_url' => $this->avatar_url,
            'roles'=>$this->whenLoaded('roles'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
