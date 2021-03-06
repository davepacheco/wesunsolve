<?php
  $h = HTTP::getInstance();
  if (!$h->css) $h->fetchCSS();
?>  
    <div id="d_content">
     <h2 class="grid_10 push_1 alpha omega">Advanced bug search</h2>
     <div class="clear"></div>
     <div class="grid_<?php echo ($h->css->s_total - $h->css->s_menu); ?> alpha omega">
      <div class="d_content_box">
       <div style="height: 30px" class="push_<?php echo $h->css->p_snet; ?> grid_<?php echo $h->css->s_snet; ?>">
        <div class="addthis_toolbox addthis_default_style" id="snet">
         <a class="addthis_button_facebook"></a>
         <a class="addthis_button_twitter"></a>
         <a class="addthis_button_email"></a>
         <a class="addthis_button_print"></a>
         <a class="addthis_button_google_plusone"></a>
        </div>
       </div>
       <div class="clear clearfix"></div>
  <form method="post" action="/bsearch/form/1">
  <div class="ctable">
  <p>Search using a bug ID or a keyword using the fields below</p>
  <table class="ctable">
    <tr><th>Bug ID:</th><td><input type="text" name="bid"/></td></tr>
    <tr><th>Full Text Search:</th><td><input type="text" name="synopsis"/></td></tr>
    <tr><th>Last activity:</th><td><select name="df">
				     <option selected value="">None</option>
				     <option value="1d">Last day</option>
				     <option value="1w">Last week</option>
				     <option value="2w">Last 2 weeks</option>
				     <option value="1m">Last month</option>
				     <option value="2m">Last 2 months</option>
				     <option value="6m">Last 6 months</option>
				     <option value="1y">Last year</option>
        		      </td></tr>
    <tr><td></td><td><input type="submit" value="search"/></td></tr>
  </table>
  </div>
  </form>
   </div><!-- d_content_box -->
  </div><!-- grid_19 -->
 </div><!-- d_content -->
