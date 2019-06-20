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


## MIT License

Copyright (c) [year] [fullname]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.