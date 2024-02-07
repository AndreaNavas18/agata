<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    // Sobrescribe el método setAttribute para convertir a mayúsculas
    public function setAttribute($key, $value)
    {
        // Verifica si el atributo no es una relación
        if (!$this->isCustomRelation($key)) {
            $value = strtoupper($value);
        }

        // Aplica strtoupper al valor antes de establecerlo en el atributo
        parent::setAttribute($key, $value);
    }

    // Sobrescribe el método getAttribute para devolver el valor en mayúsculas si no es una relación
    public function getAttribute($key)
    {
        // Verifica si el atributo no es una relación
        if (!$this->isCustomRelation($key)) {
            return strtoupper(parent::getAttribute($key));
        }

        // Si es una relación, devuelve el valor normal
        return parent::getAttribute($key);
    }

    // Método para verificar si una propiedad es una relación personalizada
    protected function isCustomRelation($key)
    {
        return method_exists($this, $key) && $this->$key() instanceof \Illuminate\Database\Eloquent\Relations\Relation;
    }
}
