<?php

namespace Users\Annotations\Readers;

use Illuminate\Support\Facades\File;
use Users\Annotations\Mappings\Action;
use Doctrine\Common\Annotations\Reader;
use Users\Annotations\Mappings\Controller;

class Permission
{
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function getPermissions()
    {
        $controllersClass = $this->getControllers();
        $declared = \get_declared_classes();

        $permissions = [];

        foreach ($declared as $className) {
            $reflected = new \ReflectionClass($className);
            if (\in_array($reflected->getFileName(), $controllersClass)) {
                $permission = $this->getPermission($className);

                if (\count($permission)) {
                    $permissions = \array_merge($permissions, $permission);
                }
            }
        }

        return $permissions;
    }

    public function getPermission($controllerClass, $action = null)
    {
        $classReflected = new \ReflectionClass($controllerClass);
        $controllerAnnotation = $this->reader->getClassAnnotation($classReflected, Controller::class);

        $permissions = [];

        if ($controllerAnnotation) {
            $permission = [
                'name' => $controllerAnnotation->name,
                'description' => $controllerAnnotation->description
            ];

            $methodsReflected = !$action ? $classReflected->getMethods() : [$classReflected->getMethod($action)];

            foreach ($methodsReflected as $method) {
                $actionAnnotation = $this->reader->getMethodAnnotation($method, Action::class);

                if ($actionAnnotation) {
                    $permission['resource_name'] = $actionAnnotation->name;
                    $permission['resource_description'] = $actionAnnotation->description;

                    $permissions[] = (new \ArrayIterator($permission))->getArrayCopy();
                }
            }
        }

        return $permissions;
    }

    public function getControllers()
    {
        $dirs = config('users.acl.controllers_annotations');
        $files = [];

        foreach ($dirs as $dir) {
            foreach (File::allFiles($dir) as $file) {
                $files[] = $file->getRealPath();
                if (isset($files)) {
                    require_once $file->getRealPath();
                }
            }
        }

        return $files;
    }
}
