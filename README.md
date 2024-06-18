##  <span style="font-size: 1.5em;">For test this app:</span>


<span style="font-size: 1.2em;">My method on **windows**:</span>

1. Install this tools:
    * [lando](https://lando.dev/download/)
    * [composer](https://getcomposer.org/download/)
    * [docker](https://www.docker.com/products/docker-desktop/)
2. In **"powershell"** use this commands in project folder:
    * "composer install"
    * "lando start"
    * "lando ssh"
    * "ln -s $PWD/storage $PWD/public/storage"
3. The output of the "lando start" command will contain text like:
   > APPSERVER URLS  
   √ https://localhost:65515 [200]\
   √ http://localhost:65516 [200]\
   √ http://kinopoisk-lite.lndo.site/ [200]\
   √ https://kinopoisk-lite.lndo.site/ [200]

4. Open any of this urls in your browser
5. To stop app use:
    * "lando stop" or stop all containers in "docker desktop"