Mavenlink API wrapper for PHP
==============================================

* This is a lightweight wrapper in PHP for the [Mavenlink Api](http://developer.mavenlink.com/)

Usage
--------

    require 'lib/mavenlink_api.php';
    $client = new MavenlinkApi('<your_api_token_here>');`

* Get all parent posts (no replies), include the user who made the post and attachments in a single request ordered by id descending

		print_r($client->getJson('posts',
					      array('parents_only' => 'true',
					      array('include' => 'attachments,user'),
					      array('order' => 'id:desc')));

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

* Get all posts unfiltered, include the user who made the post in a single request ordered by newest_reply:desc

		print_r($result = $client->getJson('posts',
							    null,
							    array('include' => 'user'),
							    array('order' => 'newest_reply:desc')));

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


* Create a post

`$result = $client->createNew('post', array('message' => 'from php wrapper', 'workspace_id' => '222'));`

    {
      "count":1,
      "posts":{"555":{"newest_reply_at":null,"message":"Hello Mavenlink","has_attachments":false,"created_at":"2013-11-06T08:53:42-08:00","updated_at":"2013-11-06T08:53:42-08:00","reply_count":0,"reply":false,"private":false,"id":"555","subject_id":null,"subject_type":null,"user_id":"111","workspace_id":"222","workspace_type":"Workspace","story_id":null}},
      "results":[{"key":"posts","id":"31521545"}]
    }

## TODO

* Add support for PUT and DELETE methods
* Update README with example usage for PUT, DELETE  examples
