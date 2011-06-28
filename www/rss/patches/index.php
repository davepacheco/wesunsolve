<?php
 require_once("../../../libs/autoload.lib.php");
 require_once("../../../libs/config.inc.php");
 $m = mysqlCM::getInstance();
 if ($m->connect()) {
    die($argv[0]." Error with SQL db: ".$m->getError()."\n");
 }

 /* Fetch last patches */
  $patches = array();
  $table = "`patches`";
  $index = "`patch`, `revision`";
  $where = " WHERE `releasedate`!='' ORDER BY `releasedate` DESC LIMIT 0,20";

  if (($idx = mysqlCM::getInstance()->fetchIndex($index, $table, $where)))
  {
    foreach($idx as $t) {
      $g = new Patch($t['patch'], $t['revision']);
      $g->fetchFromId();
      array_push($patches, $g);
    }
  }
 $now = date("D, j M Y G:i:s T");

 header("Content-Type: application/xml; charset=ISO-8859-1"); 
 HTTP::Piwik("Last Patches RSS Feed");

?> 
<rss version="2.0">
  <channel>
    <title>We sun solve - Last patches</title>
    <link>http://sunsolve.espix.org</link>
    <description>Last patches released</description>
    <language>en-us</language>
    <pubDate><?php echo $now; ?></pubDate>
    <lastBuildDate><?php echo $now; ?></lastBuildDate>
    <docs>http://sunsolve.espix.org/rss/patches</docs>
    <generator>We Sun Solve</generator>
    <managingEditor>tgo@ians.be</managingEditor>
    <webMaster>tgo@ians.be</webMaster>
<?php foreach ($patches as $p) { ?>
    <item>
     <title><?php echo $p->name(); ?>: <?php echo $p->synopsis; ?></title>
     <link>http://sunsolve.espix.org/patch/id/<?php echo $p->name(); ?></link>
     <description><?php echo $p->synopsis; ?></description>
     <pubDate><?php if ($p->releasedate) echo date("D, j M Y G:i:s T", $p->releasedate); ?></pubDate>
    </item>
<?php } ?>
  </channel>
</rss>
