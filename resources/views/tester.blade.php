{{
    $post->categories->each(function($post){
        return $post->name;
    }) 
}}