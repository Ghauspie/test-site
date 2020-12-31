<?php

namespace Oshop\Models;

class CoreModel {

    /**
     * The id of the entity
     *
     * @var int
     */
    protected $id;

    /**
     * The name of the entity
     *
     * @var string
     */
    protected $name;

    protected $created_at;
    protected $updated_at;

    /**
     * Get the value of the entity id
     * Cette méthode getter donne un accès en lecture à la propriété id
     * à tout code externe à la classe qui manipulerait des objets de cette entité
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Nous sommes ici dans un docblock :
     * c'est un commentaire particulier qui permet d'ajouter notamment
     * des précisions sur les entrées et les sorties de la méthode.
     * Cela a un intérêt pour nous développeurs et pour nos collègues
     * mais c'est aussi utile à l'éditeur de code pour nous afficher
     * des informations en plus lors de l'utilisation de la méthode.
     * /!\ Ca n'a pas d'impact sur l'exécution du code par PHP.
     * https://docs.phpdoc.org/latest/guide/guides/index.html
     * 
     * Set the value of name
     * Cette méthode setter donne un accès en écriture à la propriété name
     * à tout code externe à la classe qui manipulerait des objets de cette entité
     * 
     * @param string $name The new name of the entity
     *
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}