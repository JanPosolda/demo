# demo

## Prerekvizity
PHP 7.1, Apache, databáze MySQL 5.7

## Instalace
```bash
$ composer install
```

## Databáze
* ve složce bin je sql skript pro vytvoření databáze s tabulkou uživatelů
* v aplikace se nastaví přístupové údaje na databázi v souboru config/config.local.neon

## Popis
* aplikace vychází ze sandbox aplikace Nette
* api se zpracovává v *ApiPresenteru* ve funkci *actionUser()*
* pro práci s databází je použita ORM Doctrine

### Důležité soubory
* *entities/User.php* - doctrine entita pro popis tabulky user
* *models/Helpers.php* - třída s pomocnými funkcemi
* *presenters/ApiPresenter.php* - zpracování api požadavků 
* *services/UserService.php* - funkce pro práci s databází
* *www/demo.html* - formulář pro registraci uživatele + výpis seznamu uživatelů, volá api funkce aplikace

### Příklad spuštění
DocumentRoot nastavit na složku *www*, přesměruje se na demo.html
