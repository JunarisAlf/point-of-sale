<?php

namespace App\Http\Livewire\Master\Item;

use App\Models\Category;
use App\Models\Item;
use Exception;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class CreateItemModal extends Component{
    public $show = false;
    public $name, $category, $category_id, $has_expired, $selling_price, $barcode;
    public $categoriesSelect ;
    public function mount(){
        $this->categoriesSelect = Category::orderBy('name', 'DESC')->get();
    }
  
    protected $listeners = ['openCreateModal' => 'openModal', 'categoryChange', 'createSellingPriceChange'];
    public function openModal(){
        $this->show = true;
    }
    public function categoryChange($val){
        $this->category_id = $val;
    }
    public function createSellingPriceChange($val){
        $this->selling_price = $val;
    }
    public function generateBarcode(){
        $barcode_13 = '';
        do {
            $barcode_12 = rand(111111111111, 999999999999);
            // get checksum number
            $barcode = strrev($barcode_12); // Reverse the barcode to simplify the calculation
            $barcodeLength = strlen($barcode);
            
            // Step 1: Assign odd/even positions and multiply
            $sum = 0;
            for ($i = 0; $i < $barcodeLength; $i++) {
                $digit = (int)$barcode[$i];
                $multiplier = ($i % 2 === 0) ? 3 : 1; // Changed multiplier for odd and even positions
                $sum += $digit * $multiplier;
            }
            
            // Step 2: Calculate the remainder
            $remainder = $sum % 10;
            
            // Step 3: Calculate the checksum digit
            $checksum = ($remainder === 0) ? 0 : 10 - $remainder;
            $barcode_13 = $barcode_12 . $checksum;
        } while (Item::where('barcode', $barcode_13)->exists());
        $this->barcode = strval($barcode_13);
    }
    public function rules(){
        return [
            'barcode'       => 'required|string|min:13|max:13',
            'name'          => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'has_expired'   => 'required|boolean',
            'selling_price' => 'required|integer|min:0',
        ];
    }
    public function store(){
        $validated = $this->validate();
        try{
            Item::create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_item_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->resetExcept('categoriesSelect');
    }
    public function render() {
        return view('livewire.master.item.create-item-modal');
    }
}
