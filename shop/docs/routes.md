# Routes

## Sprint 1

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `homeAction` | home d'administration | 5 categories et 3 produit| - |
| `/mentions-legales/` | `GET` | `MainController` | `legalMentionsAction` | Mentions légales | Legal mentions | - |
| `/catalogue/categorie` | `GET` | `CatalogController` | `categoryAction` | Current category name | Category name and description from modify and create new category | Category name and description from modify and create new category  |
| `/catalogue/type` | `GET` | `CatalogController` | `typeAction` | Current type name | Type name and description from modify and create new type | [id] stands for type id |
| `/catalogue/marque` | `GET` | `CatalogController` | `brandAction` | Current brand name | Brand name and description from modify and create new brand | [id] stands for brand id |
| `/catalogue/produit` | `GET` | `CatalogController` | `productAction` | Current product name | Product name and description from modify and create new productp | [id] stands for product id |
