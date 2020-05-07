<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Zizaco\Entrust\EntrustFacade as Entrust;

class SubProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
       return  Entrust::can('List SubProduct') ? true : false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        // return (Entrust::hasRole(['admin','owner','general-user']) && Entrust::can('create-company')) ? true : false;
        return  Entrust::can('Create SubProduct') ? true : false;
    }
    

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return Entrust::can('Update SubProduct') ? true : false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        return Entrust::can('Show SubProduct') ? true : false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return Entrust::can('Delete SubProduct') ? true : false;
    }
}
