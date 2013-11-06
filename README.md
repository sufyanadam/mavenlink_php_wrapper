Mavenlink API wrapper for PHP
==============================================

* This is a lightweight wrapper in PHP for the [Mavenlink Api](http://github.com/mavenlink)

Usage
--------

    require 'lib/mavenlink_api.php';
    $client = new MavenlinkApi('<your_api_token_here>');`

* Get all parent posts (no replies), include the user who made the post and attachments in a single request ordered by id descending


`print_r($client->getJson('posts', array('parents_only' => 'true', array('include' => 'attachments,user'), array('order' => 'id:desc')));`

    {
       "count":1,
       "results":[
	  {
	     "key":"posts",
	     "id":"16270634"
	  }
       ],
       "posts":{
	  "16270634":{
	     "id":"16270634",
	     "message":"Hello World",
	     "has_attachments":true,
	     "user_id":"2",
	     "workspace_id":"2249167",
	     "attachment_ids":[
		"6700107"
	     ]
	  }
       },
       "users":{
	  "2":{
	     "id":"2",
	     "full_name":"John Doe",
	     "email_address":"johnny_doe@example.com"
	  }
       },
       "attachments":{
	  "6700107":{
	     "id":"6700107",
	     "created_at":"2013-04-15T16:48:48-07:00",
	     "filename":"turtle.jpg",
	     "filesize":16225
	  }
       }
    }

* Get all posts unfiltered, include the user who made the post in a single request ordered by newest_reply:desc

`print_r($result = $client->getJson('posts', null, array('include' => 'user'), array('order' => 'newest_reply:desc')));`

    {
       "count":1,
       "results":[
	  {
	     "key":"posts",
	     "id":"16270634"
	  }
       ],
       "posts":{
	  "16270634":{
	     "id":"16270634",
	     "message":"Hello World",
	     "has_attachments":true,
	     "user_id":"2",
	     "workspace_id":"2249167",
	     "attachment_ids":[
		"6700107"
	     ]
	  }
       },
       "users":{
	  "2":{
	     "id":"2",
	     "full_name":"John Doe",
	     "email_address":"johnny_doe@example.com"
	  }
    }

## TODO

* Add support for PUT and DELETE methods
* Update README with example usage for PUT, DELETE and CREATE examples
