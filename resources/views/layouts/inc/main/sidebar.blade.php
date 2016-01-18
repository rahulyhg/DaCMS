<div class="col-md-4">

<!-- Search -->
<div class="well">
    <h4>Search</h4>
    <div class="input-group">
        <form id="searchForm" method="post" action="{{ secure_url('search') }}">
            <input type="text" name="s" id="s" class="form-control">
            {!! Form::token() !!}
        </form>
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" form="searchForm">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</div>

<!-- Categories -->
<div class="well">
    <h4>Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php $c=1; ?>
            @foreach ($categories as $category)
            @if ($c % 2 == 0)
            <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
            @endif
            <?php $c++; ?>
            @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
            <?php $c=2; ?>
            @foreach ($categories as $category)
            @if ($c % 2 == 0)
            <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
            @endif
            <?php $c++; ?>
            @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Tags -->
<div class="well">
    <h4>Tags</h4>
    <?php

    $maximum = 0;

    foreach ($tags as $tag)
    {
        if (count($tag->posts) > $maximum)
        {
            $maximum = count($tag->posts);
        }
    }

    foreach ($tags as $tag)
    {
        if (count($tag->posts) > 0)
        {

            $percent = floor((count($tag->posts) / $maximum) * 100);

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

            echo '<a class="'.$class.'" href="'.secure_url("/tag/".$tag->slug).'">'.$tag->slug.'</a> ';
        }
    }
    ?>
</div>

<!-- Authors -->
<div class="well">
    <h4>Top 10 Authors</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            @foreach ($authors as $author)
             <li><a href="{{secure_url('/user/'.$author->id)}}">{{ $author->username }}</a> ({{ count($author->posts) }})
            @endforeach
            </ul>
        </div>
    </div>
</div>

@yield('sidebar')

</div>