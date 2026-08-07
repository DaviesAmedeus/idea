<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class UpdateIdea{

/** @var User */



public function handle(array $attributes, Idea $idea){

// dd($attributes);


$data = collect($attributes)->only([
    'title', 'description', 'status', 'links'
    ])->toArray();


    if($attributes['image'] ?? false){
        $data['image_path']= $attributes['image']->store('ideas', 'public');
    }


    DB::transaction(function() use($data, $attributes, $idea){
    $idea->update($data);
    $idea->steps()->delete();


    // $steps = collect($attributes['steps'] ?? [])->map(fn($step)=> ['description'=> $step]);
    $idea->steps()->createMany($attributes['steps'] ?? []);

    });
}

}
