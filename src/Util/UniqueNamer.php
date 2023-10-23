<?php

namespace App\Util;

use App\Entity\Image;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class UniqueNamer implements NamerInterface
{
    public function name($object, PropertyMapping $mapping): string
    {
        $extension = pathinfo($mapping->getFile($object)->getClientOriginalName(), PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '.' . $extension;

        // Définir la valeur dans la propriété uniqueName de l'entité Image
        if ($object instanceof Image) {
            $object->setUniqueName($uniqueName);
        }

        return $uniqueName;
    }
}
