<?php

namespace Pawoon\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = FALSE;
    public $primaryKey = 'id';
}
