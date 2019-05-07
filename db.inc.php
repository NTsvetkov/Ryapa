<?php
session_start();

class MyDB extends SQLite3 {

    function __construct() {
        $this->open('test.db');
    }

}

$dblink = new MyDB();


$database = 'u653658691_kur';
$user = 'u653658691_kur';
$pass = 'kurami';
$host = 'mysql.hostinger.in';

$sql = 'CREATE TABLE "orders" (
"id"  INTEGER,
"caption"  VARCHAR NOT NULL,
"link"  VARCHAR,
"date"  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
"priority"  SMALLINT NOT NULL,
"country"  VARCHAR,
"importance"  INTEGER DEFAULT 0,
PRIMARY KEY ("id" ASC)
);';

//$dblink = mysqli_connect($host, $user, $pass) or die(mysqli_error($dblink));
//mysqli_select_db($dblink, $database) or die(mysqli_error($dblink));
//mysqli_query($dblink, "SET names utf8");

$self = "index.php";
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$countries = array();

$countries[167] = "Albania";
$countries[27] = "Argentina";
$countries[169] = "Armenia";
$countries[50] = "Australia";
$countries[33] = "Austria";
$countries[83] = "Belarus";
$countries[32] = "Belgium";
$countries[76] = "Bolivia";
$countries[69] = "Bosnia and Herzegovina";
$countries[9] = "Brazil";
$countries[42] = "Bulgaria";
$countries[23] = "Canada";
$countries[64] = "Chile";
$countries[14] = "China";
$countries[78] = "Colombia";
$countries[63] = "Croatia";
$countries[171] = "Cuba";
$countries[82] = "Cyprus";
$countries[34] = "Czech Republic";
$countries[55] = "Denmark";
$countries[165] = "Egypt";
$countries[70] = "Estonia";
$countries[39] = "Finland";
$countries[11] = "France";
$countries[168] = "Georgia";
$countries[12] = "Germany";
$countries[44] = "Greece";
$countries[13] = "Hungary";
$countries[48] = "India";
$countries[49] = "Indonesia";
$countries[56] = "Iran";
$countries[54] = "Ireland";
$countries[58] = "Israel";
$countries[10] = "Italy";
$countries[45] = "Japan";
$countries[71] = "Latvia";
$countries[72] = "Lithuania";
$countries[66] = "Malaysia";
$countries[26] = "Mexico";
$countries[80] = "Montenegro";
$countries[31] = "Netherlands";
$countries[84] = "New Zealand";
$countries[170] = "Nigeria";
$countries[73] = "North Korea";
$countries[37] = "Norway";
$countries[57] = "Pakistan";
$countries[75] = "Paraguay";
$countries[77] = "Peru";
$countries[67] = "Philippines";
$countries[35] = "Poland";
$countries[53] = "Portugal";
$countries[81] = "Republic of China (Taiwan)";
$countries[79] = "Republic of Macedonia (FYROM)";
$countries[52] = "Republic of Moldova";
$countries[1] = "Romania";
$countries[41] = "Russia";
$countries[164] = "Saudi Arabia";
$countries[65] = "Serbia";
$countries[68] = "Singapore";
$countries[36] = "Slovakia";
$countries[61] = "Slovenia";
$countries[51] = "South Africa";
$countries[47] = "South Korea";
$countries[15] = "Spain";
$countries[38] = "Sweden";
$countries[30] = "Switzerland";
$countries[59] = "Thailand";
$countries[43] = "Turkey";
$countries[40] = "Ukraine";
$countries[166] = "United Arab Emirates";
$countries[29] = "United Kingdom";
$countries[74] = "Uruguay";
$countries[24] = "USA";
$countries[28] = "Venezuela";

$flags = array(
    1 => "http://i67.tinypic.com/o71unq.jpg",
    2 => "http://i65.tinypic.com/aw43lt.jpg",
    3 => "http://i67.tinypic.com/aeabut.jpg",
    4 => "http://i64.tinypic.com/2ev4sxg.jpg",
    5 => "http://i59.tinypic.com/1ibo6f.jpg",
    6 => "http://i57.tinypic.com/jzzkty.jpg",
    7 => "http://i61.tinypic.com/2wnd5hs.jpg",
);

$sessionName = 'loggedIn';

$defaults = array();

$defaults['header'] = '[img]https://s6.postimg.cc/ihiw4ej7l/header_01.png[/img][url=https://www.erepublik.com/en/newspaper/president-of-ebulgaria-240346/1][img]https://s6.postimg.cc/87gh543lt/header_02.png[/img][/url][url=https://www.erepublik.com/en/newspaper/armeiski-vestnik-159791/1][img]https://s6.postimg.cc/beb0oqvrl/header_03.png[/img][/url][url=https://www.erepublik.com/en/newspaper/bg-foreign-affairs-office-236795/1][img]https://s6.postimg.cc/uje9yii5d/header_04.png[/img][/url][url=https://www.erepublik.com/en/newspaper/bulgarian-high-commission-246755/1][img]https://s6.postimg.cc/qn0y2j4vl/header_05.png[/img][/url][url=https://www.erepublik.com/en/newspaper/bnb-news-141291/1][img]https://s6.postimg.cc/3ybr2yv7l/header_06.png[/img][/url][url=https://www.erepublik.com/en/newspaper/educational-press-220445/1][img]https://s6.postimg.cc/rcjqewkup/header_07.png[/img][/url][url=https://www.erepublik.com/en/newspaper/narodno-subranie-178930/1][img]https://s6.postimg.cc/e8e6280ip/header_08.png[/img][/url][img]https://s6.postimg.cc/pxi5q6z75/header_09.png[/img]

[i][b]ГЛАСУВАЙТЕ и КОМЕНТИРАЙТЕ тази статия, вотвайте и коментарите, за да я видят повече хора. Абонирайте се за вестника, за да получавате последните инструкции навреме.[/b][/i]

[b]Следете държавната стена за постове съдържащи статията на държавния вестник за текущия ден! Всеки нов пост означава обновление на статията, съответно и на приоритетие/заповедите![/b]

[img]http://i66.tinypic.com/30if7kk.jpg[/img][img]http://i63.tinypic.com/244s6le.jpg[/img]
';

$defaults['rws'] = '[u][b]ВАЖНО!!![/b][/u] 

[b]☆ МОЛЯ СЛЕДВАЙТЕ ИНСТРУКЦИИТЕ НА МВ ЗА ВСИЧКИ ВЪСТАНИЯ![/b]

Въстанията се вдигат организирано, от МВ и обикновено се обявяват на държавната стена!

[b][u]Моля, НЕ вдигайте и НЕ подкрепяйте въстания на своя глава, в противен случай МВ не отговаря за него и може да бъде принудено да защити дадено въстание![/u][/b]

[u][b]Валидно до второ нареждане![/b][/u]

[u][b]ВАЖНО!!![/b][/u]

[b]Относно войните с Латвия, Македония, Сърбия, Румъния, Украйна. Това са тренировъчни пинг-понг войни.

Обикновено всяка страна губи директните си битки. Ако имате съмнения, погледнете държавната стена. Който е нападнал, той трябва да изгуби. Битките в нашите региони печелим, в чуждите региони губим. Ако е нужно, помагаме отсреща, или поне не бием от грешната страна. Битки има достатъчно.

Нека не проявяваме излишен патриотизъм.[/b]

[b]ЕПИЦИ

Ако няма пречки, във вторник ще имаме Д4 епик със Сърбия. Всеки ден ще имаме Д1 епик със Сърбия около смяната на деня(00:00 ереп време или 10:00 българско време). Вторник в Д4, а всички останали дни - в Д1. За играчите без маверик - ако сте в съответната дивизия - помогнете ни за епика с бомби, ракети или фф. За легендите и мавериците - очевидно е, че вие печелите най-много от епиците, затова се нуждаем от помощта и съдействието ви, за да продължим с епиците. За въздушните отряди - използвайте бомбите си, ако имате в наличност. Най-важно е битката да влезе във “фалшив” епик колкото се може по-бързо и по-евтино - така ще се активират чуждите скриптове и това ще ни помогне да спестим много енергия, само не трябва да забравяме да контролираме щетата и да държим битката във диапазон 49.50% - 50.50% - тогава е активен “фалшивия” епик. Всички можем да помогнем това да се случи! [/b]

[b]РЕЗИДЕНЦИИ[/b]

В момента региони, определени за резиденции са [url=https://www.erepublik.com/bg/main/city/Raipur/overview]Maharashtra[/url], [url=https://www.erepublik.com/bg/main/city/Mumbai/overview]Chhattisgarh[/url] и [url=https://www.erepublik.com/bg/main/city/Liepaja]Kurzeme[/url]. 

[u][b]ВАЖНО!!![/b][/u]

';

$defaults['team'] = '[img]http://i66.tinypic.com/30if7kk.jpg[/img][img]http://i63.tinypic.com/244s6le.jpg[/img]


[u][b]Моля, добавете хора от кабинета, за да получавате актуални инструкции на стената на приятелите ви[/b].[/u]

Президент [url=https://www.erepublik.com/bg/citizen/profile/3295754]MattrimCauthon[/url]

Министър-председател [url=https://www.erepublik.com/bg/citizen/profile/6253497]dzynka[/url]

Министър на Отбраната [url=https://www.erepublik.com/bg/citizen/profile/9443681]Mo0nShad0w[/url]

Министър на Външните работи [url=https://www.erepublik.com/bg/citizen/profile/4388308]Rand Al Cauthon[/url]

Управител [url=https://www.erepublik.com/bg/citizen/profile/3515650]Gias Gouliev[/url]

Министър на Образованието [url=https://www.erepublik.com/bg/citizen/profile/9391931]GEX99[/url]
';

$defaults['footer'] = '[img]http://i58.tinypic.com/2m68qy9.jpg[/img][img]http://i61.tinypic.com/2lt62va.jpg[/img]

[img]http://i67.tinypic.com/28gv0hj.jpg[/img]
[b][url=https://discordapp.com/invite/Pb6Zcrf]EBulgaria Discord Channel[/url]
[url=https://www.erepublik.com/en/article/-bulgaria-discord--2632936/1/20]Какво е Discord?[/url][/b]


[url=http://www.erepublik.com/en/newspaper/educational-press-220445/1][img]http://i58.tinypic.com/5x4nrm.jpg[/img][/url][url=http://forum.ebulgaria.biz/][img]http://i58.tinypic.com/6hpaa9.jpg[/img][/url][url=http://mibbit.com/#bg-army@irc.rizon.net][img]http://i61.tinypic.com/2ldygdj.jpg[/img][/url]

[img]http://i62.tinypic.com/n3kxhe.jpg[/img]
';
