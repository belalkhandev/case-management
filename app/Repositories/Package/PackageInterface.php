<?php
namespace App\Repositories\Package;

interface PackageInterface{

    public function packages();

    public function package($id);

    public function packageStore($data);

    public function packageUpdate($data, $id);

    public function packageDelete($id);

}
