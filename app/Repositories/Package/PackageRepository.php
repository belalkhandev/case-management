<?php
namespace App\Repositories\Package;

use App\Models\Package;
use PHPUnit\Framework\Constraint\ArrayHasKey;

class PackageRepository implements PackageInterface {

    public function packages()
    {
        $packages = Package::all();

        if ($packages->isNotEmpty()) {
            return $packages;
        }

        return false;
    }

    public function package($id)
    {
        $package = Package::find($id);

        if ($package) {
            return $package;
        }

        return false;
    }

    public function packageStore($request)
    {
        $package = new Package();
        $package->name = $request->get('name');
        $package->description = $request->get('description');
        $package->status = $request->get('status');

        $path = null;
        if ($request->hasFile('image')) {
            //upload image
        }

        $package->image = $path;

        if ($package->save()) {
            return $package;
        }

        return false;
    }

    public function packageUpdate($request, $id)
    {
        $package = Package::find($id);
        $package->name = $request->get('name');
        $package->description = $request->get('description');
        $package->status = $request->get('status');

        if ($request->hasFile('image')) {
            //upload image
        }

        if ($package->save()) {
            return $package;
        }

        return false;
    }

    public function packageDelete($id)
    {
        //delete created package
    }
}
