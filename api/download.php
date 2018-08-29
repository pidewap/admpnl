<textarea id="code" name="contents" style="width: 100%; min-height: 200px" rows="35">{% set title = 'Download ' ~ data.fulltitle ~ ' - BeLagu' %}
{% set url = current_url %}
{% set desc %}{{ data.fulltitle }}, Download lagu {{ data.fulltitle }}, Free Download {{ data.fulltitle }} Mp3, Video {{ data.fulltitle }}, Download Lagu {{ data.fulltitle }}, Music Video {{ data.fulltitle }}, {{ data.description|replace({"\n":' ', "\r":' '}) }}{% endset %}
{% set kw %}{{ data.fulltitle }},Download {{ data.fulltitle }} Mp3,lagu {{ data.fulltitle }},{{ data.fulltitle }} mp3,lirik lagu {{ data.fulltitle }}, music video {{ data.fulltitle }}, download {{ data.fulltitle }} free song{% endset %}
{% set ogimage %}
&lt;meta property="og:image" content="https://ytimg.googleusercontent.com/vi/{{ data.video_id }}/hqdefault.jpg"&gt;
{% endset %}
<?php 
function xrvel_curl($url) { 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
    curl_setopt($ch, CURLOPT_HEADER, false); 
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
    @curl_setopt($ch, CURLOPT_MAXREDIRS, 2); 
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6'); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'/cookie.txt'); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'/cookie.txt'); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_REFERER, $url); 
    $res = trim(curl_exec($ch)); 
    curl_close($ch); 
    unset($ch); 
    return $res; 
} 

function my_get_google_hot_trend($country_code) { 
    $result = array( 
        'data' => array(), 
        'error' => '' 
    ); 

    $res = xrvel_curl('http://www.google.com/trends/hottrends/widget?pn='.$country_code.'&tn=50&h=413'); 

    if ($res == '') { 
        $result['error'] = 'Failed. Empty response.'; 
        return $result; 
    } 

    if (!preg_match_all("/\<span class='widget-title-in-list'\>(.*)\<\/span\>\<\/span\>\<span class='widget-list-more-arrow/siU", $res, $match)) { 
        $result['error'] = 'Failed to parse.'; 
        return $result; 
    } 

    $keywords = $match[1]; 

    $result['data'] = $keywords; 
    return $result; 
} 

$keyword = my_get_google_hot_trend('p19'); 

echo '{% set topsearch = {
';
foreach ($keyword['data'] as &$value) {
    $n=rand(0,100000);
echo ''.$n.': {title: "'.str_replace(',','',str_replace('"','',$value)).'"},
';
}
echo '
} %}';
?>
                  <?php
$content=file_get_contents('http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/ws/RSS/topsongs/limit=15/json'); 
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

{{ block( 'header' ) }}
{{ block( 'search' ) }}


    {% if data %}
  &lt;div class="wrapper"&gt;&lt;div class="menu-home"&gt;&lt;h2 class="title-menu"&gt;Download Part&lt;/h2&gt;
&lt;div class="notifin"&gt;
Download &lt;strong&gt;{{ data.fulltitle|raw }}&lt;/strong&gt; as video and song. This content is free of copyright, &lt;b&gt;<?php echo $config['wap']; ?>&lt;/b&gt; is a free search engine.
&lt;/div&gt;
  &lt;div class="menulist"&gt;
&lt;div style="border-top:0px dashed #ddd;margin:20px 0px 5px;padding:5px 3px;"&gt;&lt;div id="play" align="center"&gt;
&lt;center&gt;
&lt;img width="50px" src="http://i.ytimg.com/vi/{{ data.video_id }}/1.jpg" alt="Thumbnail 1"&gt;&lt;img width="50px" src="http://i.ytimg.com/vi/{{ data.video_id }}/2.jpg" alt="Thumbnail 2"&gt;&lt;img width="50px" src="http://i.ytimg.com/vi/{{ data.video_id }}/3.jpg" alt="Thumbnail 3"&gt;
&lt;br&gt;
&lt;br&gt;
&lt;iframe src="https://www.youtube.com/embed/{{ data.video_id }}" frameborder="0" width="80%" height="100%" allowfullscreen=""&gt;&lt;/iframe&gt;&lt;/center&gt;
&lt;/div&gt;&lt;/div&gt;&lt;center&gt;&lt;a href="http://facebook.com/dialog/feed?display=touch&amp;amp;app_id=163741137001917&amp;amp;redirect_uri=http%3A%2F%2Ffacebook.com&amp;amp;caption=<?php echo $config['wap']; ?>&amp;amp;link={{ url }}" title="Share {{ data.fulltitle }} to Facebook" target="_blank"&gt;&lt;img alt="Facebook" src="https://1.bp.blogspot.com/-rn6pUAdkiXk/WlhctuPnuxI/AAAAAAAABHk/1qs3xQWDp-szAsZdJjM-zinFQuwee0KtgCEwYBhgL/s1600/share%2Bto%2Bfacebook.png" height="28"&gt;&lt;/a&gt;
&lt;a href="https://twitter.com/share?url={{ url }}&amp;amp;text=<?php echo $config['wap']; ?> - Download {{ data.fulltitle|raw }}&amp;amp;related=" title="Share {{ data.fulltitle }} to Twitter" target="_blank"&gt;&lt;img alt="Twitter" src="https://4.bp.blogspot.com/-BryZVrdqJ5A/WCyEgpI-s8I/AAAAAAAAAbs/WY5OddyZ7BMQ0Fl2x9bh3WI3UXbpEPEdQCPcBGAYYCw/s1600/twitter.png" height="28"&gt;&lt;/a&gt;
&lt;a href="http://plus.google.com/share?url={{ url }}" title="Share {{ data.fulltitle|raw }} to Google+" target="_blank"&gt;&lt;img alt="Google+" src="https://4.bp.blogspot.com/-kUvdCZ1WdHw/WlhdTgwryEI/AAAAAAAABHw/c6bFvqM1wuAh9_OBONMRNW6lc6VVk5RFQCEwYBhgL/s1600/share%2Bto%2Bgoogle-plus.png" height="28"&gt;&lt;/a&gt; &lt;a href="http://pinterest.com/pin/create/button/?url={{ url }}&amp;amp;description=Download {{ data.fulltitle }}" title="Share {{ data.fulltitle }} to Pinterest" target="_blank"&gt;&lt;img alt="Pinterest" src="https://2.bp.blogspot.com/-1f4Co4h4FjM/Wlhd_rDk_XI/AAAAAAAABIA/FF-SZZqGiLEo6PDYsJi6-_UGwVjBJPk0gCEwYBhgL/s1600/share%2Bto%2Bpinterest.png" height="28"&gt;&lt;/a&gt;&lt;/center&gt;&lt;h3 class="pageku"&gt;&lt;center&gt;{{ data.fulltitle }}&lt;/center&gt;&lt;/h3&gt;
    &lt;table style="font-size:14px;padding:2px;" width="100%"&gt;&lt;tbody&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Name&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;&lt;b&gt;{{ data.fulltitle }}&lt;/b&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Category&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;&lt;b&gt;{{ data.categories.0|raw }}&lt;/b&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Artist&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;&lt;b&gt;&lt;a href="/music/{{ data.uploader|raw }}" target="_blank" title="Free Download All {{ data.uploader|raw }}"&gt;{{ data.uploader|raw }}&lt;/a&gt;&lt;/b&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Date&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;{{ data.upload_date|date('Y M d') }}&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Duration&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;{{ data.duration|gmdate('H:i:s') }}&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Size&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;Based Quality&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Rate&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;-&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Hits&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;-&lt;/td&gt;&lt;/tr&gt;&lt;tr valign="top"&gt;&lt;td width="30%"&gt;Encoder&lt;/td&gt;&lt;td&gt;:&lt;/td&gt;&lt;td&gt;PideWAP&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;
    &lt;br&gt; &lt;a class="btn-cloud" rel="nofollow" href="<?php echo $config['direct']; ?>"&gt;FAST DOWNLOAD&lt;/a&gt;
     &lt;a class="btn-cloud" rel="nofollow" href="https://cdn-waphan.herokuapp.com/adl.php?id={{ data.video_id }}&amp;type=720p"&gt;Download 720p - mp4&lt;/a&gt;&lt;a class="btn-cloud" rel="nofollow" href="https://cdn-waphan.herokuapp.com/adl.php?id={{ data.video_id }}&amp;type=360p"&gt;Download 360p - mp4&lt;/a&gt;&lt;a class="btn-cloud" rel="nofollow" href="https://cdn-waphan.herokuapp.com/adl.php?id={{ data.video_id }}&amp;type=360w"&gt;Download 360 - webm&lt;/a&gt;&lt;a class="btn-cloud" rel="nofollow" href="https://cdn-waphan.herokuapp.com/adl.php?id={{ data.video_id }}&amp;type=240p"&gt;Download 240p - 3gp&lt;/a&gt;&lt;a class="btn-cloud" rel="nofollow" href="https://cdn-waphan.herokuapp.com/adl.php?id={{ data.video_id }}&amp;type=144p"&gt;Download 144p - 3gp&lt;/a&gt;&lt;a class="btn-cloud" rel="nofollow" href="https://www.convertmp3.io/fetch/?video=https://www.youtube.com/watch?v={{ data.video_id }}"&gt;Download mp3 - 320kbps&lt;/a&gt;&lt;/div&gt;

&lt;div class="notifin"&gt;Free download video and song entitled &lt;strong&gt;{{ data.fulltitle|raw }}&lt;/strong&gt; from &lt;b&gt;<?php echo $config['wap']; ?>&lt;/b&gt; search engine. Content is automatically generated by system.&lt;/div&gt;

&lt;div class="title-menu"&gt;&lt;b&gt;Share&lt;/b&gt;&lt;/div&gt;
    &lt;center&gt;URL Code&lt;br&gt;&lt;textarea&gt;{{ url }}&lt;/textarea&gt;&lt;br&gt;Forum Code&lt;br&gt; &lt;textarea&gt;[url={{url }}]Download {{ data.fulltitle|raw }}[/url]&lt;/textarea&gt;&lt;br&gt;HTML Code&lt;br&gt;&lt;textarea&gt;&amp;lt;a href="{{ url }}"&amp;gt;Download {{ data.fulltitle|raw }}&amp;lt;/a&amp;gt;&lt;/textarea&gt;&lt;/center&gt;
  
    &lt;div class="title-menu"&gt;&lt;b&gt;Related Contents&lt;/b&gt;&lt;/div&gt;
    {% if vsp_last_viewed_videos|length &gt; 0 %}
    {% for video in vsp_last_viewed_videos|slice(0, 10) %}
&lt;div class="menulist"&gt;&lt;table&gt;&lt;tbody&gt;
&lt;tr valign="middle"&gt;
&lt;td valign="top"&gt;&lt;/td&gt;
&lt;td valign="top"&gt;
&lt;div style="font-size:14px;"&gt;&lt;a href="/download/music/{{ video.id }}/linkdownload.html"&gt;{{ video.title|raw }}&lt;/a&gt;&lt;/div&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
                    {% endfor %}
    {% endif %}
    
    {% else %}
        &lt;p&gt;Something went wrong. Please come back later.&lt;/p&gt;
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
    
    &lt;div class="title-menu"&gt;Trending Search&lt;/div&gt;
      {% if top|length &gt; 0 %}
{% for video in top|slice(0, 15) %}
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
    
    {{ block ('recent_searches') }}
&lt;/div&gt;&lt;/div&gt;

{{ block( 'footer' ) }}

&lt;/body&gt;</textarea>
