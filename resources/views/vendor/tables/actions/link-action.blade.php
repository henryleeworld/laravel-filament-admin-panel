<x-tables::actions.action
    :action="$action"
    component="tables::link"
    :icon-position="$getIconPosition()"
    class="filament-tables-link-action"
>
    {{ __(trim($getLabel())) }}
</x-tables::actions.action>
