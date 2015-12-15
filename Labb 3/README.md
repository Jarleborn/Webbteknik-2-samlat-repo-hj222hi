
## Vad finns det för krav du måste anpassa dig efter i de olika API:erna?

Min första impuls när jag läste frågan var "men det var ju vldigt kravlöst, man kan ju göra vad man vill". Men sen funderade jag lite till.

SR.se apiet kräver att man på ett eller annat sätt tillåter "Access-Control-Allow-Origin". Jag gör detta genom att använda mig av en Node.JS server. Man skulle också kunna göra det med hjälp av en proxylösning.

Sen så finns det ju två uppenbara krav på utveklaren. Nämlingen att båda apierna kräver att man är bekväm med att använda JSON eller XML för att kunna hantera datan man får tillbaka. Och att man läser dokumentationen ordentligt.

## Hur och hur länga cachar du ditt data för att slippa anropa API:erna i onödan?

Jag har använt mig av localstorage och sparara datan i 15 minuter. När den tiden har passerat görs det automatiskt en ny request mot servern för att få ny data. Detta sker på server sidan. Så med andra ord så har jag ingen cache på servr sidan. Det är också så att jag "bara" cachar datan från sr apiet. Efter att ha läst på extra om cache har jag förståt att jag skulle kunna cahat andra statiska element så som kartan.

Jag valde att spara datan i 15 minuter för då tänker jag att man hinner navigera runt sidan utan onödiga laddningstider. Och om man vill kolla en gång till så borde den ha hunnit kolla så att datan är färsk.

## Vad finns det för risker kring säkerhet och stabilitet i din applikation?

Den säkerhets risken jag hittar är att jag kör funktionen initmap som en callback i anropet mot google. Dett skapar en risk då det öppnar för att en användaren ska kunna mata in annan kod i den callbacken.

Den stora stabillitets risken är att jag kallar på ny data så for cachen töms. Problemet med detta uppstår om användaren har sidna uppe på en flik en längre tid utan att anävnda den, för då kommer sidan gör onödiga requests mot servern.  

## Hur har du tänkt kring säkerheten i din applikation?

Då applikationen inte hanterar någon direkt kännsligdata, och inte har några uppenbara möjligheter att skicka in skadlig kod (Mer än det som nämns i ovanstående stycke) så känns det som att applikationen är relatit säker utan att jag aktivt säkrat den.

## Hur har du tänkt kring optimeringen i din applikation?

Som jag skrev innan så kan det finnas en risk att det görs en del onödiga request mot servern. Men jag tänker att en tjänst av den här typen går man antigen in och kollar innan man ska ge sig ut på vägarna och sedan stänger eller så har man ett extremt speciall intresse där man låter sidan vara uppe av en anledning.

Jag har verkligen kämpat för att ha så lite DRY som möjligt. det ända kod delen som stör mig är när jag initsierar knapparna för kategorier. Där återanvänds ipincip samma kod fyra gånger.

I övrigt så är scripten inlänkade i botten av sidan och css en i toppen. Jag har inte använt någon form av minifiering då jag tycker att filerna redan hade en storlek som passade bra.

Som jag skrev om i cache delen så skulle man kunnna cacha statiska element på sidan så som kartan för att slippa ladda om den varje gång man går in på sidan. Men min egenhändiga testning har vissat att det inte tar mer tid än att det borde vara lugnt.
