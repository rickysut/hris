<div x-data="asyncData">
    <x-moonshine::form.switcher
        :attributes="$element->attributes()"
        :id="$element->id()"
        :name="$element->name()"
        :onValue="$element->getOnValue()"
        :offValue="$element->getOffValue()"
        :@change="(($autoUpdate ?? false) ? 'updateColumn(`'.route('moonshine.update-column').'`, `'.$element->field().'`, `'.$item->getKey().'`, `'.addslashes(get_class($item)).'`, $event.target.checked)' : 'true')"
        :value="($element->getOnValue() == $element->formViewValue($item) ? $element->getOnValue() : $element->getOffValue())"
        :checked="$element->getOnValue() == $element->formViewValue($item)"
    />
</div>
