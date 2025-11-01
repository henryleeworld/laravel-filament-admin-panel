<td colspan="5" class="fi-ta-cell">
    {{ __('Total:') }}
</td>
<td class="fi-ta-cell fi-align-center">
    <div class="px-4 py-3">
        {{ money($this->getTableRecords()->sum('subtotal')) }}
    </div>
</td>
<td class="fi-ta-cell fi-align-center">
    <div class="px-4 py-3">
        {{ money($this->getTableRecords()->sum('taxes')) }}
    </div>
</td>
<td class="fi-ta-cell fi-align-center">
    <div class="px-4 py-3">
        {{ money($this->getTableRecords()->sum('total')) }}
    </div>
</td>
