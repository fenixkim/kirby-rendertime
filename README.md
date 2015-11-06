# Kirby Rendertime Plugin

Quickly show the php-rendertime of your Kirby page in the code, on the page or in the browser-tab.

More info - https://forum.getkirby.com/t/show-php-rendertime-on-page/2277

## Installation

1. Download the [Plugin](https://github.com/dmotion/kirby-rendertime/zipball/master).
2. Copy the downloaded folder in `site/plugins` of your site as `rendertime/`

## Usage

Enable the plugin by adding the following variables in yout `site/config/config.php` file of your development environment:

	c::set(array(
	  'rendertime'        => true,
	  'rendertime.type'   => 1,
	  'rendertime.format' => 'Page rendered in {totaltime} seconds @ {rendertime}',
	));

Add `RenderTime::start()` in your header:

	<?php RenderTime::start() ?>
	
	<!DOCTYPE html>
	...

And `RenderTime::end()` in your footer:
	
	...
	<?php RenderTime::end() ?>
	</html>

### The `rendertime.type` variable

Accepts several values (integer only):

* `1`: Show rendertime in code
* `3`: Show rendertime in page
* `5`: Show rendertime on tab

You can also take the sum of these individual numbers;

* 1 and 3 = `4`: This will show the rendertime in both pag and code
* 1 and 5 = `6`: This will show it in code and on tab
* 1 and 3 and 5 = `9`: This will show it all over the place
* etc...