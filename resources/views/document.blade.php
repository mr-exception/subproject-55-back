<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subproject 55 - back</title>
  <link rel="stylesheet" href="https://stackedit.io/style.css" />
</head>

<body class="stackedit">
  <div class="stackedit__html"><h1 id="subproject-55---tina">Subproject 55 - tina</h1>
<h2 id="introduction">introduction</h2>
<p>In this repository, the backend of the project is located. This project has a set of api, so that the frontend can access the information it needs. No information storage or hiding is performed by this section. All information is directly (and maybe under partial filters that does not change the nature of the information) received from its source and transmitted to the frontend.</p>
<h2 id="list-of-contents">list of contents</h2>
<ol>
<li><a href="#dependencies">dependencies</a></li>
<li><a href="#how-to-install">how to install</a></li>
<li><a href="#apis">apis</a></li>
<li><a href="#resources">resources</a></li>
</ol>
<h3 id="dependencies">Dependencies</h3>
<ul>
<li><a href="https://php.net/">PHP</a> &gt;= 7.1</li>
<li><a href="https://laravel.com/docs/5.8">Laravel</a> &gt;= 5.8</li>
<li><a href="https://github.com/thujohn/twitter">thujohn/twitter</a> &gt;= 2.2</li>
</ul>
<h3 id="how-to-install">How to install</h3>
<p><strong>Step 0</strong>: clone the project<br>
<strong>Step 1</strong>: create an app in <a href="https://developer.twitter.com/en/apps">twitter developers</a> to get required token (<code>API key</code>, <code>API secret key</code>, <code>Access token</code>, <code>Access token secret</code>)<br>
<strong>Step 2</strong>: copy <code>.env.example</code> in root dir of project to <code>.env</code><br>
<strong>Step 3</strong>: run <code>php artisan key:generate</code><br>
<strong>Step 4</strong>: add these lines to the end of <code>.env</code>:</p>
<pre><code>TWITTER_CONSUMER_KEY={consumer_key}
TWITTER_CONSUMER_SECRET={cunsumer_secret}
TWITTER_ACCESS_TOKEN={access_token}
TWITTER_ACCESS_TOKEN_SECRET={access_token_secret}
</code></pre>
<blockquote>
<p>notice that you have to place you own application tokens here<br>
<strong>Step 5</strong>: run the project by <code>php artisan serve</code></p>
</blockquote>
<blockquote>
<p>If you want to use the project in apache/nginx webservers. then just move the project to their root folder and open <code>http://path-to-project/public_html</code></p>
</blockquote>
<h3 id="apis">Apis</h3>
<p>apis are the only part of this project. they are a bridge from twitter to all front projects in subproject-55. here are them</p>
<h4 id="search-useruser"><code>/search-user/{user}</code></h4>
<p>this api searches in users of twitters and returns the profile if found. notice that private users can’t be fetched due to security reasons. if user found, response would be:</p>
<pre><code>{
	"ok": true,
	"user": [User Resource]
}
</code></pre>
<blockquote>
<p>for more information about response visit <a href="#user-resource">user resource</a></p>
</blockquote>
<p>but if failure if user not found. response would be:</p>
<pre><code>{
	"ok": false,
	"code": 50,
	"error": "user not found"
}
</code></pre>
<p>otherwise, if there was another error like <code>server fatality</code> or <code>ddos error</code>,  then response would be:</p>
<pre><code>{
	"ok": false,
	"code": 0,
	"error": "unknown error"
}
</code></pre>
<h4 id="tweetsuser"><code>/tweets/{user}</code></h4>
<p>this api resolves tweets of a users. is case of success, response would have a array of tweets, also all retweets are in array too. you can seperate retweets by <code>is_retweet</code> key in <a href="#tweet-resource">tweet resource</a>. if user found and was public (tweets were available) then response would be:</p>
<pre><code>{
	"ok": true,
	"tweets": [[tweet resource]]
}
</code></pre>
<p>if user not found then response would be:</p>
<pre><code>{
	"ok": false,
	"code": 50,
	"error": "user not found"
}
</code></pre>
<p>otherwise, if there was another error like <code>server fatality</code> or <code>ddos error</code>,  then response would be:</p>
<pre><code>{
	"ok": false,
	"code": 0,
	"error": "unknown error"
}
</code></pre>
<p>size of response array is related to target user and twiiter has different politics for each user (popularity and user activity volume is involved). but you can</p>
<h4 id="friendsuser"><code>/friends/{user}</code></h4>
<h4 id="followersuser"><code>/followers/{user}</code></h4>
</div>
</body>

</html>
