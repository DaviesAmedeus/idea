<?php

use App\Models\Idea;

it('requires authentication', function(){

$idea = Idea::factory()->create();
$this->get(route('idea.show', $idea))->assertRedirectToRoute('login');

});
