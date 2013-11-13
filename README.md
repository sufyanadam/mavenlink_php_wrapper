# Mavenlink API wrapper for PHP

This is a lightweight wrapper in PHP for the [Mavenlink Api](http://developer.mavenlink.com/)

## Usage

    require 'lib/mavenlink_api.php';
    $client = new MavenlinkApi('<your_api_token_here>');`

## Fetching Posts

Fetch recent posts across your workspaces:

	$client->getJson('posts');

Fetch a specific post:
	$client->getJson('posts', array('only' => '222'));

Include associated objects:
	$client->getJson('posts', array('only' => '222', 'include' => 'story,user'));

Filter posts:

	$client->getJson('posts', array('parents_only' => 'true'));

Just combine parameters if you want to:

	$client->getJson('posts', array('parents_only' => 'true', 'include' => 'story,user', 'order' => 'newest_repy_at:desc'));


## Creating a new Post

You can create Posts as follows:

    $client->createNew('post', array('message' => 'Hello world!', 'workspace_id' => '444'));

## Updating an existing Post

You can edit Posts as follows:

	$client->update('post', array('id' => '111', 'message' => 'HELLO WORLD!!'));

## Destroying an existing Post

You can delete Workspace Posts by passing in the id of the post as follows:

    $client->delete('post', '111');


# Stories

## Fetching Stories

You can access all of your own stories from all workspaces you are in through the API as follows:

	$client->getJson('stories');

## Associated Objects

You can include stories' associations with the `include` param.  For example, to include returned stories'  workspaces, you would do the following:

	$client->getJson('stories', array('include' => 'workspace'));

## Filtering Stories

To get all stories with a `start_date` in the year 2013:

	$client->getJson('stories', array('starting_between' => '2013-01-01:2013-12-31'));

## Searching Stories

You can among the stories that you have access to by passing a `search` param and query string:

	$client->getJson('stories', array('search' => 'readme'));


## Ordering Stories

	$client->getJson('stories', array('order' => 'importance'));

## Creating a new Story

You can create stories as follows:

	$client->createNew('story', array('workspace_id' => '111', 'title' => 'Finish documenting README', 'story_type' => 'task'));


## Updating an existing Story

You can edit Stories as follows:

	$client->update('story', array('id' => '32915685', 'title' => 'Publish README'));

## Destroying an existing Story

You can delete Stories as follows:

    $client->delete('story', '222');
