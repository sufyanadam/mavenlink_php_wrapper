# Mavenlink API wrapper for PHP

This is a lightweight wrapper in PHP for the [Mavenlink Api](http://developer.mavenlink.com/)

## Usage

    require 'lib/mavenlink_api.php';
    $client = new MavenlinkApi('<your_api_token_here>');`

## Fetching resources

To get a JSON array of a particular resource, you can call `getJson` with
the name of the resource in plural form and an array of any params as
the first and second arguments respectively. For example:

    $client->getJson('posts', array('parents_only' => 'true', 'include' => 'story,user', 'order' => 'newest_repy_at:desc'));

## Creating resources

Call `createNew` with the name of the resource in singular form as the
first argument and an array containing the resource attributes. For example:

    $client->createNew('time_entry', array('workspace_id' => '999', 'date_performed' => '09/09/99', 'notes' => 'stuff!!!!!', 'rate_in_cents' => '3000', 'billable' => 'true', 'time_in_minutes' => '120'));

## Updating resources

Call `update` with the name of the resource in singular form as the first argument
and an array containing the id of the resource and the attributes to be updated. For example:

    $client->update('story', array('id' => '901020', 'title' => 'Update all action items'));

## Deleting resources

Call `delete` with the name of the resource in singular form as the
first argument and the id of the resource to be deleted as the second argument.
For example:

    $client->delete('story', '555');

# More examples

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

You can search among the stories that you have access to by passing a `search` param and query string:

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

## Other resources

Use the examples described above to guide you through working with all other resources exposed via the [Mavenlink Api](http://developer.mavenlink.com/)

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new pull request
