@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Tag list';
$layout->description = 'List of all popular tags that have been used in this website.';
$layout->keywords = 'tag list, tags';
$layout->canonical = secure_url('tags');
?>
@endsection

@section('content')

<section id="widepage">

<h1>Tag list</h1>

<div id="tagcloud" class="rounded">
<?php

if($tags)
{

    $maximum = 0;

    // get maximum
    foreach ($tags as $tag)
    {
        if (count($tag->posts)+count($tag->projects) > $maximum)
        {
            $maximum = count($tag->posts)+count($tag->projects);
        }
    }

    // sorting tags
    for ($i=0; $i < count($tags); $i++ )
    {
        for ($j=0; $j < count($tags)-1; $j++ )
        {
            if (count($tags[$j]->posts) + count($tags[$j]->projects) < count($tags[$j+1]->posts) + count($tags[$j+1]->projects) )
            {
                $t = $tags[$j]; $tags[$j] = $tags[$j+1]; $tags[$j+1] = $t;
            }
        }
    }

    // display tags
    foreach($tags as $tag)
    {
        if(count($tag->posts)+count($tag->projects) > 0)
        {
            $n = count($tag->posts)+count($tag->projects);

            $percent = floor(($n / $maximum) * 100);

            // determine the class based on the percentage
            if ($percent < 20):
                $class = 'smallest';
            elseif ($percent >= 20 and $percent < 40):
                $class = 'small';
            elseif ($percent >= 40 and $percent < 60):
                $class = 'medium';
            elseif ($percent >= 60 and $percent < 80):
                $class = 'large';
            else:
                $class = 'largest';
            endif;

            echo '<a class="'.$class.'" href="'.secure_url("tag/".$tag->slug).'" title="'.$n.'">'.$tag->name.'</a> ';
        }
    }
}
?>
</div>

</section>
@endsection