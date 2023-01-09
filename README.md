# Webbtjänst för projektarbete 

## Användning av restwebbtjänst
CRUD är implementerat och kan användas enligt tabellerna nedan.
Se metoder och ändpunkter i tabeller. 

## Använda tabellen Products
I tabellen <i> products </i> lagras alla företagets produkter.

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/products  | Listar alla produkter         |
| GET           | /api/products/1  | Listar produkt med id 1            |
| POST           | /api/products  | Adderar product till databas           |
| PUT           | /api/products/1  | Uppdaterar produkt med id 1            |
| PUT           | /api/productcategories/category/{categoryname} | Uppdaterar <i> produkt i produkttabell </i> med nytt kategorinamn
| DELETE           | /api/products/1  | Raderar produkt med id 1           |

Notera att klientdelen aldrig hämtar alla produkter utan använder ändelsen <i> /status/ </i> för att hämta antingen aktiva eller arkiverade produkter

### Sökfunktioner till tabellen Products

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/products/search/status/{status} | Addera ändelsen actice/inactive för att lista aktiva/arkiverde produkter |
| GET           | /api/products/search/categoryname/{categoryname} | Listar produkter från samma produktkategori
| GET           | /api/products/search/articlenumber/{article}  | Listar alla produkter med sekvens av artikelnummer som överensstämmer med sökning         |
| GET           | /api/products/search/productname/{productname}  | Listar alla produkter med sekvens av produktnamn som överensstämmer med sökning         |

### Värden att skicka med i POST-anrop till products
Alla värden är obligatoriska.

```json
{
  
  "article_number" : ,
  "product_name" : "",
  "product_description" : "",
  "product_category" : "",
  "amount_in_stock" : ,
  "status" : ""

}
```

## Använda tabellen Product_categories
I tabellen <i> product_categories </i> lagras alla kategorier.

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/productcategories  | Listar alla produktkategorier        |
| GET           | /api/productcategories/category/{categoryname}  |   Hämtar kategorier från medskickad parameter       |
| POST           | /api/productcategories  | Adderar kategori till databas           |
| PUT           | /api/productcategories/1  | Uppdaterar kategori med id 1            |
| DELETE           | /api/productcategories/1  | Raderar kategori med id 1           |

### Värden att skicka med i POST-anrop till product_categories
Endast category_name är obligatoriskt.

```json
{
    
  "category_name" : ,
  "category_description" : "", 
   
}
```



## Använda tabellen report_messages
I tabellen <i> report_messages</i> lagras avvikelser som kan förekomma på företagets produkter

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/reportmessage  | Listar alla avvikelserapporter         |
| POST           | /api/reportmessage  | Adderar avvikelsemeddelande till databas           |
| DELETE           | /api/reportmessage/1  | Raderar avvikelsemeddelande med id 1           |

### Sökfunktionalitet till tabellen report_messages

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/reportmessage/search/articlenumber/{article}  | Listar alla avvikelserapporter med sekvens av artikelnummer som överensstämmer med sökning        |


### Värden att skicka med i POST-anrop till report_message
Alla värden är obligatoriska.

```json
{
    
  "article_number" : ,
  "message" : "", 
  "product_id" : 
   
}
```

## Använda tabellen amount_change_logs
I tabellen <i> amount_change_logs</i> lagras alla ändrigar av lagerantal på produkter.
Denna tabell anropas vid ändring av antal produkter i tabellen <i>products</i>. Kan ej manuellt ändras. 

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/amountchangelog  | Listar alla antalsändringar         |
| GET           | /api/amountchangelog/search/latest  | Hämtar de 30 senaste loggarna sorterat på senaste uppdateirng         |

| POST           | /api/amountchangelog  | Adderar antalsändring till databas           |

### Sökfunktionalitet för tabellen amount_change_logs

| Metod         | Ändpunkt        | Beskrivning   
| ------------- | -------------   | --------    |
| GET           | /api/amountchangelog/search/articlenumber/{article}  | Listar alla antalsändringar med sekvens av artikelnummer som överensstämmer med sökning        |



### Värden som skickas med i ett POST-anrop till amount_change_logs


```json
{
    
  "article_number" : ,
  "old_amount" : , 
  "new_amount" : , 
  "modified_with" : , 
  "product_id" :
   
}
```




### Klona repo
Använd kommando "git clone https://github.com/Webbutvecklings-programmet/moment-2-backend-ramverk-rasmus-ason.git" för att klona ner repo lokalt.

