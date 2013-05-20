Hola
====
<p align="justify">
ho-la [oh-lah] <br/>

1. used as an informal greeting.
2. an informal exclamation of enthusiasm, joy, etc.
</p>


Setup
----
<p align="justify">
1. Download the project: $git clone https://github.com/pablohenrique/Hola.git <br/>
2. Open project directory (on linux: $/var/www/Hola/) <br/>
3. Download the composer: $curl -sS https://getcomposer.org/installer | php <br/>
4. Download peej/Tonic through composer: $php composer.phar install --dev <br/>
5. Open the .htaccess file which is inside the Hola folder and copy the commented code <br/>
6. Add the code to this file (and, of course, remove commentaries): $sudo nano /etc/apache2/sites-available/default <br/>
7. Pronto! Test the project using this URL: localhost/Hola
</p>

Futuras Ideias
----
<p align="justify">
Alterar base de dados colocar um campo que define se o convidado confirmou ou não a 
presença no evento tipo um confirmado_recusado_maybe

além de criar evento na nossa plataforma, usar a api do facebook 
para criar lá também e convidar amigos lá


precisaremos de um observer para notificar convidados.
</p>