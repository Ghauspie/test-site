# Routes

## Sprint 1

| URL | HTTP Method | Controller | Method | Title | Content | Comment |
|--|--|--|--|--|--|--|
| `/` | `GET` | `MainController` | `homeAction` | Dans les shoe | 5 categories | - |
| `/mentions-legales/` | `GET` | `MainController` | `legalMentionsAction` | Mentions légales | Legal mentions | - |
| `/catalogue/categorie/[id]` | `GET` | `CatalogController` | `categoryAction` | Current category name | Category name and description, all products from this category | [id] stands for category id |
| `/catalogue/type/[id]` | `GET` | `CatalogController` | `typeAction` | Current type name | Type name, all products from this type | [id] stands for type id |
| `/catalogue/marque/[id]` | `GET` | `CatalogController` | `brandAction` | Current brand name | Brand name, all products from this brand | [id] stands for brand id |
| `/catalogue/produit/[id]` | `GET` | `CatalogController` | `productAction` | Current product name | Product name, products details and description | [id] stands for product id |
