# deletesysts3
# Script requested by https://r4p3.net/members/growndex.34027/

* Introdu detalii necesare in config.php <br>
* Incarca in phpmyadmin baza de date channels.sql<br>
* Dupa primii 2 pasi tot ce ti-a ramas de facut este sa pornesti scriptul.<br>

Acesta va rula odata la 5 minute prin comanda :

*/5 * * * * /usr/bin/php -f /directia/pana/la/fisierul/index.php

* Comanda de mai sus se introduce in crontab.
* Pentru a deschide crontab tastezi comanda : crontab -e
