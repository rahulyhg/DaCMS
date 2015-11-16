@extends('layouts.main')

@section('content')

<section id="widepage">

<h1>Disqus Sync</h1>

<div>
<?php

do {

    if(count($comments) > 1)
        {

                // unset duplicate comment
                unset($comments[0]);

            $n = 0;

            // save posts locally
            foreach ($comments as $comment) {

                    $slug = $comment->thread->identifiers[0];

                    if (strpos($slug,'blog/') !== false)
                    {
                        $slug = str_replace("blog/","",$slug);
                    }

                    if (strpos($slug,'/') !== false)
                    {
                        $slug = str_replace("/","",$slug);
                    }

                    $data = array(
                        'comment_id' => $comment->id,
                        'parent_id' => $comment->parent,
                        'slug' => $slug,
                        'body' => strip_tags($comment->message),
                        'author_name' => $comment->author->name,
                        'profile_url' => $comment->author->profileUrl,
                        'gravatar_url' => $comment->author->avatar->permalink,
                        'date' => $comment->createdAt
                    );

                    DB::table('comments')->insert($data);

                    $n++;

            }
            echo "<p><strong>Action: </strong> {$n} new comments added to DB</p>";
        } else { echo "<p><strong>THERE ARE NO NEW COMMENTS</strong></p>"; }

} while (count($comments) == 50);

?>
</div>

</section>

@endsection