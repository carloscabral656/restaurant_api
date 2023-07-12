<?php
/**
 * Created by PhpStorm.
 * User: ccabral
 * Date: 11/07/2023
 * Time: 15:36
 */

namespace App\Services\Addresses;

use App\Models\Address;
use App\Services\ServiceAbstract;
use Illuminate\Database\Eloquent\Model;

class AddressesServiceConcrete extends ServiceAbstract
{
    public function __construct(Address $model)
    {
        parent::__construct($model);
    }
}