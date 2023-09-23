<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable
{
    use HasFactory;

    public function getAuthIdentifierName()
    {
        return 'id'; // Replace with the actual column name for the unique identifier.
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Assuming the primary key column is 'id'.
    }

    public function getAuthPassword()
    {
        return $this->password; // Assuming the hashed password is stored in a 'password' column.
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Replace with the actual column name for the remember token.
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Replace with the actual column name for the remember token.
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Replace with the actual column name for the remember token.
    }
}

