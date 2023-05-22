<?php

declare(strict_types=1);

namespace MoonShine\Fields;

use Illuminate\Support\Collection;
use MoonShine\Contracts\Decorations\FieldsDecoration;
use MoonShine\Decorations\Decoration;
use MoonShine\Decorations\Tabs;
use MoonShine\Exceptions\FieldsException;
use MoonShine\Filters\Filter;
use ReflectionClass;
use ReflectionException;
use Throwable;

abstract class FormElements extends Collection
{
    /**
     * @throws Throwable
     */
    private function withdrawFields($fieldsOrDecorations, array &$fields): void
    {
        foreach ($fieldsOrDecorations as $fieldOrDecoration) {
            if ($fieldOrDecoration instanceof FormElement) {
                $fields[] = $fieldOrDecoration;
            } elseif ($fieldOrDecoration instanceof Tabs) {
                foreach ($fieldOrDecoration->tabs() as $tab) {
                    $this->withdrawFields($tab->getFields(), $fields);
                }
            } elseif ($fieldOrDecoration instanceof Decoration) {
                $this->withdrawFields($fieldOrDecoration->getFields(), $fields);
            }
        }
    }

    public function withParents(): FormElements
    {
        return $this->map(static function ($fieldsOrDecoration) {
            if ($fieldsOrDecoration instanceof FormElement) {
                return $fieldsOrDecoration->setParents();
            }

            return $fieldsOrDecoration;
        });
    }

    /**
     * @return FormElements<Field|Filter>
     * @throws Throwable
     */
    public function onlyFields(): FormElements
    {
        $fieldsOrDecorations = [];

        $this->withdrawFields($this->toArray(), $fieldsOrDecorations);

        return self::make($fieldsOrDecorations);
    }

    /**
     * @return FormElements<Field|Filter>
     * @throws Throwable
     */
    public function whenFields(): FormElements
    {
        return $this->onlyFields()
            ->filter(static fn (FormElement $field) => $field->hasShowWhen())
            ->values();
    }

    /**
     * @throws Throwable
     */
    public function whenFieldNames(): FormElements
    {
        return $this->whenFields()->mapWithKeys(static function (FormElement $field) {
            return [$field->showWhenField => $field->showWhenField];
        });
    }

    /**
     * @throws Throwable
     */
    public function isWhenConditionField(string $name): bool
    {
        return $this->whenFieldNames()->has($name);
    }

    /**
     * @return array<string, string>
     * @throws Throwable
     */
    public function extractLabels(): array
    {
        return $this->onlyFields()->flatMap(static function ($field) {
            return [$field->field() => $field->label()];
        })->toArray();
    }


    /**
     * @param  string  $resource
     * @param  ?FormElement  $default
     * @return ?FormElement
     * @throws Throwable
     */
    public function findByResourceClass(string $resource, FormElement $default = null): ?FormElement
    {
        return $this->onlyFields()->first(static function (FormElement $field) use ($resource) {
            return $field->resource()
                && $field->resource()::class === $resource;
        }, $default);
    }

    /**
     * @param  string  $relation
     * @param  ?FormElement  $default
     * @return ?FormElement
     * @throws Throwable
     */
    public function findByRelation(string $relation, FormElement $default = null): ?FormElement
    {
        return $this->onlyFields()->first(static function (FormElement $field) use ($relation) {
            return $field->relation() === $relation;
        }, $default);
    }

    /**
     * @param  string  $column
     * @param  ?FormElement  $default
     * @return ?FormElement
     * @throws Throwable
     */
    public function findByColumn(string $column, FormElement $default = null): ?FormElement
    {
        return $this->onlyFields()->first(static function (FormElement $field) use ($column) {
            return $field->field() === $column;
        }, $default);
    }

    /**
     * @throws Throwable
     */
    public function onlyColumns(): FormElements
    {
        return $this->onlyFields()->transform(static function (FormElement $field) {
            return $field->field();
        });
    }

    /**
     * @throws ReflectionException|FieldsException
     */
    public function wrapIntoDecoration(string $class, string $label): FormElements
    {
        $reflectionClass = new ReflectionClass($class);

        if (! $reflectionClass->implementsInterface(FieldsDecoration::class)) {
            throw FieldsException::wrapError();
        }

        return self::make([new $class($label, $this->toArray())]);
    }
}
