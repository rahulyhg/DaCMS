<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
        	[
	            'id' => 1,
	            'user_id' => 1,
	            'slug' => 'hello-world',
	            'title' => 'Hello World!',
	            'lang' => 'en',
	            'isVisible' => 1,
	            'isPublished' => 1,
	            'isHL' => 0,
	            'isDisqus' => 1,
	            'description' => 'Hello World example blog post.',
	            'keywords' => 'DaCMS, demo, hello world',
	            'robots' => 'all',
	            'resume' => '"Hello World" example blog post.',
	            'content' => '<p><strong>Hello World!</strong> This is just a demo post.</p>'
        	],
        	[
	            'id' => 2,
	            'user_id' => 2,
	            'slug' => 'lorem-ipsum',
	            'title' => 'Lorem ipsum',
	            'lang' => 'en',
	            'isVisible' => 1,
	            'isPublished' => 1,
	            'isHL' => 0,
	            'isDisqus' => 1,
	            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
	            'keywords' => 'DaCMS, demo, lorem ipsum',
	            'robots' => 'all',
	            'resume' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.',
	            'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!'],
        	]);

		// tags to posts
        DB::table('tags_to_posts')->insert([
        	[
	            'tag_id' => 1,
	            'post_id' => 1,
        	],
        	[
	            'tag_id' => 2,
	            'post_id' => 1,
        	],
        	[
	            'tag_id' => 2,
	            'post_id' => 2,
        	],
        ]);

        // categories to posts
        DB::table('categories_to_posts')->insert([
        	[
	            'category_id' => 1,
	            'post_id' => 1,
        	],
        	[
	            'category_id' => 1,
	            'post_id' => 2,
        	]
        ]);
    }
}
