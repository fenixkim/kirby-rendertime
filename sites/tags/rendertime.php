<?php

function rendertime($caller)
  {
    switch($caller)
    {
      case 'start':

        $time = microtime();
        $time = explode(' ',$time);
        $time = $time[1]+$time[0];
        $start = $time;
        DEFINE('RENDERSTART',$start);

      break;
      default:

        $time = microtime();
        $time = explode(' ',$time);
        $time = $time[1]+$time[0];
        $finish = $time;
        $total_time = round(($finish-RENDERSTART),4);
//      date_default_timezone_set('Europe/Amsterdam');
        $data = explode('-#|#|#-',strip_tags(preg_replace('#"#',"''",$caller)));
        $rendertype = $data[0];
        $rendertext = $data[1];
        $rendertime = date('d/m/Y - H:i:s',time());

        $render_code = chr(10).'<!-- '.preg_replace('#@#',$total_time,$rendertext).' @ '.$rendertime.' -->'.chr(10);
        $render_page = chr(10).'<p id="rendertime"><b><pre>'.preg_replace('#@#',$total_time,$rendertext).' @ '.$rendertime.'</pre></b></p>'.chr(10);
        $render_tab  = chr(10).'<script>document.title = "'.preg_replace('#@#',$total_time,$rendertext).' @ '.$rendertime.'"</script>'.chr(10);

          switch($rendertype)
            {
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

      break;
    }
  }

kirbytext::$tags['rendertime'] = array('attr' => array('text'),'html' => function($tag)
  {
$type = $tag->attr('rendertime');
$text = $tag->attr('text','page rendered in @ seconds');
return $type.'-#|#|#-'.$text;
  });

?>
