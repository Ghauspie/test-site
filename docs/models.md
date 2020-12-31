## Modèle

Le modèle est une classe et donc un plan de fabrication représentant une entité de la BDD.
Pour fabriquer se plan, on se calque sur le nom et les champs de la table correspondante dans la BDD.
Un modèle possède des propriétés et des méthodes.

Les modèles sont codés dans des classes spécifiques qui permettent de manipuler les données utilisées par notre site web.

Avec Active Record, ce sont les modèles qui s'occupe d'aller chercher les informations dans la BDD (pour cela on crée des méthodes dans le classe du modèle).

## Objet
Les objets sont des instanciations de classes. Des objets issus de la même classe possède les mêmes propriétés et ont accès aux mêmes méthodes (celles qui sont définies dans la classe dont ils sont issus) mais ils peuvent avoir chacun des valeurs de propriétés différentes.

Exemple pour le modèle Brand :
Les objets créés à partir de la classe modèle Brand, correspondent chacun à une ligne de la table 'brand' dans la BDD.