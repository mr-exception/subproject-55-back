# Subproject 55 - tina

## introduction

In this repository, the backend of the project is located. This project has a set of api, so that the frontend can access the information it needs. No information storage or hiding is performed by this section. All information is directly (and maybe under partial filters that does not change the nature of the information) received from its source and transmitted to the frontend.

## dependecies

* [PHP](https://php.net/) >= 7.1
* [Laravel](https://laravel.com/docs/5.8) >= 5.8
* [thujohn/twitter](https://github.com/thujohn/twitter) >= 2.2

## how to install

**Step 0**: clone the project

**Step 1**: create an app in [twitter developers](https://developer.twitter.com/en/apps) to get required token (`API key`, `API secret key`, `Access token`, `Access token secret`)

**Step 2**: copy `.env.example` in root dir of project to `.env`

**Step 3**: run `php artisan key:generate`

**Step 4**: add these lines to the end of `.env`:
```
TWITTER_CONSUMER_KEY={consumer_key}
TWITTER_CONSUMER_SECRET={cunsumer_secret}
TWITTER_ACCESS_TOKEN={access_token}
TWITTER_ACCESS_TOKEN_SECRET={access_token_secret}
```
> notice that you have to place you own application tokens here

**Step 5**: run the project by `php artisan serve`

> If you want to use the project in apache/nginx webservers. then just move the project to their root folder and open `http://path-to-project/public_html`