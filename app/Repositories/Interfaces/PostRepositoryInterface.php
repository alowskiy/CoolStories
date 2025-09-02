<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function all();

    public function getByID($id);

    public function create($cred);

    public function delete($id);
}
