<?php
if($_GET['cat'] == 'toplist'){
            $linkurl='http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/ws/RSS/topsongs/limit=100/json';
            $ltitle='TOP List';
}
if($_GET['cat'] == 'dangdut'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=1274/json';
            $ltitle='Dangdut';
}
if($_GET['cat'] == 'kpop'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=51/json';
            $ltitle='K-POP';
}
if($_GET['cat'] == 'jpop'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=27/json';
            $ltitle='J-POP';
}
if($_GET['cat'] == 'cpop'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=1250/json';
            $ltitle='C-POP';
}
if($_GET['cat'] == 'india'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=1262/json';
            $ltitle='India';
}
if($_GET['cat'] == 'anime'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=29/json';
            $ltitle='Anime';
}
if($_GET['cat'] == 'indo'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=1259/json';
            $ltitle='Indonesia';
}
if($_GET['cat'] == 'malay'){
            $linkurl='https://itunes.apple.com/us/rss/topsongs/limit=100/genre=1255/json';
            $ltitle='Malaysia';
}
?>
<textarea id="code" name="contents" style="width: 100%; min-height: 200px" rows="35">{% set desc = '<?php echo $ltitle; ?> - <?php echo $config['wap']; ?>' %}
{% set kw = '<?php echo $ltitle; ?> - <?php echo $config['wap']; ?>' %}
{% set title = '<?php echo $ltitle; ?> - <?php echo $config['wap']; ?>' %}

<?php
$content=file_get_contents($linkurl); 
$top_albums=json_decode($content);
$tracks = $top_albums->feed->entry;
echo '{% set top = {
';
foreach( $tracks as $track ) {
$img = $track->{'im:image'}[0]->label;
  $title = $track->{'im:name'}->label;
  $artist = $track->{'im:artist'}->label;
$n=rand(0,100000);
echo ''.$n.': {title: "'.str_replace(',','',str_replace('"','',$title)).'", artist: "'.str_replace(',','',str_replace('"','',$artist)).'", img: "'.$img.'"},
';
}
echo '
} %}';
?>

{% use '_blocks' %}

{{ block( 'head_tags' ) }}

&lt;body&gt;

{{ block( 'search' ) }}
  
  &lt;div class="wrapper"&gt;&lt;div class="menu-home"&gt;&lt;h2 class="title-menu"&gt;<?php echo $ltitle; ?> - 100 Music&lt;/h2&gt;
&lt;div class="notifin"&gt;Latest update on: <?php echo date("l, Y-m-d"); ?>&lt;/div&gt;
  
  {% if top|length &gt; 0 %}
{% for video in top|slice(0, 100) %}
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;&lt;a title="{{ video.title|raw }} - {{ video.artist|raw }}" href="/music/{{ video.title|raw|lower|replace({' ':"-"}) }}-{{ video.artist|raw|lower|replace({' ':"-"}) }}"&gt;{{ video.title|raw }} - {{ video.artist|raw }}&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
      {% endfor %}
    {% endif %}
  
  &lt;/div&gt;&lt;div class="menu-sidebar"&gt;&lt;h3 class="title-menu"&gt;Audio Categories&lt;/h3&gt;
&lt;div class="notifin"&gt;Categories based on popular pages by users.&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/toplist.html" title="TOP List"&gt;TOP List&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/dangdut.html" title="Dangdut"&gt;Dangdut&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/kpop.html" title="K-POP"&gt;K-POP&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/jpop.html" title="J-POP"&gt;J-POP&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
  &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/cpop.html" title="C-POP"&gt;C-POP&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/india.html" title="India"&gt;India&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/anime.html" title="Anime"&gt;Anime&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    &lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/indo.html" title="Indo Pop"&gt;Indo Pop&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;» &lt;a href="/malay.html" title="Malay Pop"&gt;Malay Pop&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
    
    &lt;/div&gt;&lt;/div&gt;
    {{ block( 'footer' ) }}

&lt;/body&gt;</textarea>
