<?php

namespace App\Livewire\Shared;

use App\Enums\Occasion;
use Livewire\Attributes\On;
use Livewire\Component;

class FilterPanel extends Component
{
    public bool $isOpen = false;

    /** @var array<int, string> */
    public array $selectedSizes = [];

    /** @var array<int, string> */
    public array $selectedColors = [];

    /** @var array<int, string> */
    public array $selectedOccasions = [];

    public ?string $selectedPriceRange = null;

    /** @var array{sizes: array<int, string>, colors: array<int, string>, occasions: array<int, string>, priceRanges: array<int, array{label: string, min: int, max: int}>} */
    public array $filterOptions = [
        'sizes' => ['PP', 'P', 'M', 'G', 'GG'],
        'colors' => ['Rosé', 'Nude', 'Off-white', 'Bege', 'Branco', 'Champagne', 'Dourado'],
        'occasions' => [],
        'priceRanges' => [
            ['label' => 'Até R$ 150',         'min' => 0,   'max' => 150],
            ['label' => 'R$ 150 - R$ 300',    'min' => 150, 'max' => 300],
            ['label' => 'R$ 300 - R$ 450',    'min' => 300, 'max' => 450],
            ['label' => 'Acima de R$ 450',    'min' => 450, 'max' => 9999],
        ],
    ];

    public function mount(): void
    {
        $this->filterOptions['occasions'] = array_column(Occasion::cases(), 'value');
    }

    #[On('open-filters')]
    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function toggleSize(string $size): void
    {
        $this->toggleInArray($this->selectedSizes, $size);
    }

    public function toggleColor(string $color): void
    {
        $this->toggleInArray($this->selectedColors, $color);
    }

    public function toggleOccasion(string $occasion): void
    {
        $this->toggleInArray($this->selectedOccasions, $occasion);
    }

    public function clearAll(): void
    {
        $this->selectedSizes = [];
        $this->selectedColors = [];
        $this->selectedOccasions = [];
        $this->selectedPriceRange = null;
        $this->dispatch('filters-applied', filters: $this->filtersPayload());
    }

    public function apply(): void
    {
        $this->dispatch('filters-applied', filters: $this->filtersPayload());
        $this->close();
    }

    /** @return array<string, mixed> */
    protected function filtersPayload(): array
    {
        return [
            'sizes' => $this->selectedSizes,
            'colors' => $this->selectedColors,
            'occasions' => $this->selectedOccasions,
            'priceRange' => $this->selectedPriceRange,
        ];
    }

    /** @param  array<int, string>  $array */
    protected function toggleInArray(array &$array, string $value): void
    {
        if (in_array($value, $array, true)) {
            $array = array_values(array_diff($array, [$value]));
        } else {
            $array[] = $value;
        }
    }

    public function render()
    {
        return view('livewire.shared.filter-panel');
    }
}
