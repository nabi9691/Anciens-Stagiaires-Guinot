<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container2kRMdfZ\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container2kRMdfZ/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container2kRMdfZ.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container2kRMdfZ\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \Container2kRMdfZ\srcApp_KernelDevDebugContainer([
    'container.build_hash' => '2kRMdfZ',
    'container.build_id' => 'b3c60e12',
    'container.build_time' => 1653809387,
], __DIR__.\DIRECTORY_SEPARATOR.'Container2kRMdfZ');
