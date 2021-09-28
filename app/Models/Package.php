<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * Many to many relation between packages and services
     *
     * @return object --services that belongs to current package
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_service', 'package_id', 'service_id');
    }

    /**
     * Check if current package has specific services
     *
     */

    public function hasService($service, $requireAll = false)
    {
        if (is_object($service)) {
            $service = $service->name;
        }

        if (is_array($service)) {
            if(!isset($service['name'])) {
                return $this->hasServices($service, $requireAll);
            }

            $service = $service['name'];
        }

        if ($this->services()->where('name', $service)->first()) {
            return true;
        }

        return false;
    }

    /**
     * Check if current package has multiple services.
     *
     */
    public function hasServices($services, $requireAll = false)
    {
        foreach ($services as $service) {
            $hasServ = $this->hasService($service, $requireAll);

            if ($hasServ && !$requireAll) {
                return true;
            } elseif (!$hasServ && $requireAll) {
                return false;
            }
        }

        return $requireAll;
    }

    /**
     * Attach service to current package.
     *
     */
    public function attachService($service)
    {
        if (is_object($service)) {
            $service = $service->getKey();
        }
        if (is_array($service)) {
            if(!isset($service['id'])) {
                return $this->attachServices($service);
            }

            $service = $service['id'];
        }

        $this->services()->attach($service);
    }

    /**
     * Attach multiple services to current package.
     *
     * @param mixed $services
     * @return void
     */
    public function attachServices($services)
    {
        foreach ($services as $service) {
            $this->attachService($service);
        }
    }

    /**
     * Detach service from current package.
     *
     */
    public function detachService($service)
    {
        if (is_object($service)) {
            $service = $service->getKey();
        }
        if (is_array($service)) {
            if(!isset($service['id'])) {
                return $this->detachServices($service);
            }

            $service = $service['id'];
        }

        $this->services()->detach($service);
    }

    /**
     * Detach multiple services from current package
     *
     * @param mixed $services
     * @return void
     */
    public function detachServices($services = null)
    {
        if (!$services) $services = $this->services()->get();
        foreach ($services as $service) {
            $this->detachService($service);
        }
    }
}
