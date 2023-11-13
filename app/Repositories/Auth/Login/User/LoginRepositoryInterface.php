<?php
namespace App\Repositories\Auth\Login\User;

interface LoginRepositoryInterface{
    public function login($request,$model);
    public function logout($request);
}