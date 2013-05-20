Hola
====

Hola (oh.la) - Sera um aplicativo web que facilitara o convite de pessoas para um evento, assim como a partilha de itens necessarios para que isso aconteca.
Um exemplo seria um evento de churrasco. O provedor do churrasco convidara as pessoas e tambem, automaticamente, ja pedira as pessoas o que elas devem levar para o churrasco. O programa procura repartir as quantidades de cada item para o churrasco de forma igualitaria entre os convidados, assim como rastreia o numero de convites que foram enviados e quem aceitou, recusou ou esta como pendente uma resposta se vai ou nao para o evento.

Melhorar esse trem...


Instalacao
===
Baixar o projeto: git clone https://github.com/pablohenrique/Hola.git
Abrir a pasta do projeto (linux: /var/www/Hola/)
Baixar o composer: curl -sS https://getcomposer.org/installer | php
Instalar o Tonic: php composer.phar install --dev
Abra o arquivo .htaccess e copie o que esta comentado ( ' # ' e usado para comentar codigo)
Va ate a pasta sites-available do apache e modifique o arquivo default: sudo nano /etc/apache2/sites-available/default
Agora, cole o que voce copiou do .htaccess neste arquivo default e retire os comentarios.
Pronto! Pode testar agora.


Futuras Ideias
===

Alterar base de dados colocar um campo que define se o convidado confirmou ou não a 
presença no evento tipo um confirmado_recusado_maybe

além de criar evento na nossa plataforma, usar a api do facebook 
para criar lá também e convidar amigos lá


precisaremos de um observer para notificar convidados.
