# Requêtes o'Shop

## Exemple

<details><summary>Liste de tous les produits</summary>

```sql
SELECT * FROM `product`
```

</details>

## Pied de page

<details><summary>Les 5 types pour la liste du footer</summary>

```sql
SELECT *
FROM `type`
WHERE `footer_order` > 0
ORDER BY `footer_order` ASC
LIMIT 5
```

</details>

<details><summary>Les 5 marques pour la liste du footer</summary>

```sql
SELECT *
FROM `brand`
WHERE `footer_order` > 0
ORDER BY `footer_order` ASC
LIMIT 5
```

</details>

## Accueil

<details><summary>Liste des 5 catégories mises en avant triées par ordre d'apparition</summary>

```sql
SELECT *
FROM `category`
WHERE `home_order` > 0
ORDER BY `home_order` ASC
LIMIT 5
```

</details>

## Produit

<details><summary>Les données d'un produit à partir de son id ET le nom de la marque ET le nom de la catégorie</summary>

```sql
SELECT `product`.*, `brand`.`name` AS `brand_name`, `category`.`name` AS `category_name`
FROM `product`
INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id`
INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
```

</details>

## Catégorie

<details><summary>Les données d'une catégorie en fonction de son id</summary>

```sql
SELECT *
FROM `category`
WHERE `id` = 2
```

</details>

<details><summary>La liste des produits qui appartiennent à une catégorie donnée (avec le nom du type pour chaque produit)</summary>

```sql
SELECT `product`.`id`, `product`.`name`, `product`.`price`, `product`.`picture`, `type`.`name` AS `type_name`
FROM `product`
INNER JOIN `type` ON `type`.`id` = `product`.`type_id`
WHERE `product`.`category_id` = 1
```

</details>

## Type

<details><summary>Les informations d'un type en fonction de son id</summary>

```sql
SELECT *
FROM `type`
WHERE `id` = 4
```

</details>

<details><summary>La liste des produits qui sont d'un type donné</summary>

```sql
SELECT *
FROM `product`
WHERE `type_id` = 2
``` 

</details>

## Marque

<details><summary>Les informations d'une marque en fonction de son id</summary>

```sql
SELECT *
FROM `brand`
WHERE `id` = 3
```

</details>

<details><summary>La liste des produits qui sont fabriqués par une marque donnée (avec le type de chaque produit)</summary>

```sql
SELECT `product`.`id`, `product`.`name`, `product`.`price`, `product`.`picture`, `type`.`name` AS `type_name`
FROM `product`
INNER JOIN `type` ON `type`.`id` = `product`.`type_id`
WHERE `product`.`brand_id` = 1
```

</details>