<?php

/**
* Rendertime plugin for kirby
* See the forum: https://forum.getkirby.com/t/show-php-rendertime-on-page/2277
*/
class RenderTime {
  
  static public function now() {
    $time = microtime();
    $time = explode(' ', $time);
    return $time[1]+$time[0];
  }
  
  static public function start() {
    
    if (!c::get('rendertime', false)) return;
    
    $time = microtime();
    $time = explode(' ', $time);
    $time = $time[1] + $time[0];
    $start = self::now();
    
    DEFINE('RENDERSTART', $start);
  }
  
  static public function end() {
    
    if (!c::get('rendertime', false)) return;
    
    $finish = self::now();
    $total_time = round(($finish-RENDERSTART), 4);
    
    // date_default_timezone_set('Europe/Amsterdam');
    $rendertype = c::get('rendertime.type', 1);
    $rendertext = c::get('rendertime.format', 'Page rendered in {totaltime} seconds @ {rendertime}');
    $rendertime = date('Y/m/d - H:i:s', time());
    
    $result = str::template($rendertext, array(
      'totaltime'  => $total_time,
      'rendertime' => $rendertime
    ));
    
    $render_code = PHP_EOL . str::template('<!-- {result} -->', array('result' => $result)) . PHP_EOL;
    $render_page = PHP_EOL . str::template('<p id="rendertime"><b><pre>{result}</pre></b></p>', array('result' => $result)) . PHP_EOL;
    $render_tab  = PHP_EOL . str::template('<script>document.title = "{result}"</script>', array('result' => $result)) . PHP_EOL;

    switch($rendertype) {
      case 1: /* code */
        echo $render_code;
      break;
      case 3: /* page */
        echo $render_page;
      break;
      case 4: /* code and page */
        echo $render_page;
        echo $render_code;
      break;
      case 5: /* tab */
        echo $render_tab;
      break;
      case 6: /* code and tab */
        echo $render_code;
        echo $render_tab;
      break;
      case 8: /* page and tab */
        echo $render_page;
        echo $render_tab;
      break;
      case 9: /* page, tab and code */
        echo $render_page;
        echo $render_code;
        echo $render_tab;
      break;
      default: /* error */
        echo $render_code;
      break;
    }
  }
}