<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;
use Rector\Laravel\Rector\FuncCall\FactoryFuncCallToStaticCallRector;
use Rector\Laravel\Rector\MethodCall\RedirectBackToBackHelperRector;
use Rector\Laravel\Rector\Namespace_\FactoryDefinitionRector;
use Rector\Laravel\Rector\PropertyFetch\OptionalToNullsafeOperatorRector;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Naming\Rector\Class_\RenamePropertyToMatchTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\Privatization\Rector\Class_\RepeatedLiteralToClassConstantRector;
use Rector\PSR4\Rector\FileWithoutNamespace\NormalizeNamespaceByPSR4ComposerAutoloadRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ArrayShapeFromConstantArrayReturnRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/tests',
    ]);

    $containerConfigurator->import(SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::CODING_STYLE);
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::EARLY_RETURN);
    $containerConfigurator->import(SetList::NAMING);
    $containerConfigurator->import(SetList::PRIVATIZATION);
    $containerConfigurator->import(SetList::PSR_4);
    $containerConfigurator->import(SetList::TYPE_DECLARATION);
    $containerConfigurator->import(SetList::TYPE_DECLARATION_STRICT);
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_81);

    $containerConfigurator->import(LaravelSetList::LARAVEL_ARRAY_STR_FUNCTION_TO_STATIC_CALL);
    $containerConfigurator->import(LaravelSetList::LARAVEL_CODE_QUALITY);
    $containerConfigurator->import(LaravelSetList::LARAVEL_LEGACY_FACTORIES_TO_CLASSES);

    $services = $containerConfigurator->services();
    $services->set(FactoryDefinitionRector::class);
    $services->set(FactoryFuncCallToStaticCallRector::class);
    $services->set(OptionalToNullsafeOperatorRector::class);
    $services->set(RedirectBackToBackHelperRector::class);

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::IMPORT_SHORT_CLASSES, true);
    $parameters->set(Option::SKIP, [
        NormalizeNamespaceByPSR4ComposerAutoloadRector::class,
        ArrayShapeFromConstantArrayReturnRector::class,
        RemoveNonExistingVarAnnotationRector::class,
        RepeatedLiteralToClassConstantRector::class,
        FinalizeClassesWithoutChildrenRector::class,
        RenamePropertyToMatchTypeRector::class,
        RenameParamToMatchTypeRector::class
    ]);
};
