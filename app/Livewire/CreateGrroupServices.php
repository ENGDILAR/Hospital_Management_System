<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Group;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class CreateGrroupServices extends Component
{
    public $GroupsItems = [];
    public $allServices = [];
    public $discount_value = 0;
    public $taxes = 17;
    public $name_group;
    public $notes;
    public $ServiceSaved = false;
    public $ServiceUpdated = false;//first we dont want to update any table so we give it false value
    public $show_table = true; //a variable sended to the create page to show the table of groups services and hide the add page
    public $updateMode = false;// to told savegroup in the begenning  that i didnot choose edit group
    public $group_id;

    public function mount()
    {
        $this->allServices = Service::all();
    }

    public function render()
    {

        $total = 0;
        foreach ($this->GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }

        return view('livewire.GroupServices.create-grroup-services', [
            // a values like combact sended to the view 
            'groups'=>Group::all(),
            'subtotal' => $Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'total' => $Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);

    }


    public function addService()
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.');
                return;
            }
        }

        $this->GroupsItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];

        $this->ServiceSaved = false;
    }

    public function editService($index)
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->GroupsItems[$index]['is_saved'] = false;
    }


    public function saveService($index)
    {
        $this->resetErrorBag();
        $product = $this->allServices->find($this->GroupsItems[$index]['service_id']);
        $this->GroupsItems[$index]['service_name'] = $product->name;
        $this->GroupsItems[$index]['service_price'] = $product->price;
        $this->GroupsItems[$index]['is_saved'] = true;
    }

    public function removeService($index)
    {
        unset($this->GroupsItems[$index]);
        $this->GroupsItems = array_values($this->GroupsItems);
    }

    public function saveGroup()
    {
        // we use this function to update or insert group so we define a variable 
        //updateMode will bee true only when i came from edit form
        // update comes from submit button of create group services
        if($this->updateMode){
            $Groups = Group::find($this->group_id);//this group come from editgroup
            $total = 0;
            foreach ($this->GroupsItems as $groupItem) {
                if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                    // الاجمالي قبل الخصم
                    $total += $groupItem['service_price'] * $groupItem['quantity'];
                }
            }
            //الاجمالي قبل الخصم
            $Groups->Total_before_discount = $total;
            // قيمة الخصم
            $Groups->discount_value = $this->discount_value;
            // الاجمالي بعد الخصم
            $Groups->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
            //  نسبة الضريبة
            $Groups->tax_rate = $this->taxes;
            // الكمية
            $Groups->quantity = $this->quantity;
            // الاجمالي + الضريبة
            $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
            $Groups->save();
            // حفظ الترجمة
            $Groups->name=$this->name_group;
            $Groups->notes=$this->notes;
            $Groups->save();
            // حفظ العلاقة
            $Groups->service_group()->detach();
            foreach ($this->GroupsItems as $GroupsItem) {
                //take the id of group and the service and attach it with quantity to sotre them in the db
                $Groups->service_group()->attach($GroupsItem['service_id'],['quantity' => $GroupsItem['quantity']]);
            }

            $this->ServiceSaved = false;
            $this->ServiceUpdated = true;

        }

        else{

            // insert
            $Groups = new Group();
            $total = 0;

            foreach ($this->GroupsItems as $groupItem) {
                if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                    // الاجمالي قبل الخصم
                    $total += $groupItem['service_price'] * $groupItem['quantity'];
                }
            }

            //الاجمالي قبل الخصم
            $Groups->Total_before_discount = $total;
            // قيمة الخصم
            $Groups->discount_value = $this->discount_value;
            // الاجمالي بعد الخصم
            $Groups->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
            //  نسبة الضريبة
            $Groups->tax_rate = $this->taxes;
            // الاجمالي + الضريبة
            $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
            $Groups->save();

            // حفظ الترجمة
            $Groups->name=  $this->name_group;
            $Groups->notes= $this->notes;
            $Groups->save();

            // حفظ العلاقة
            foreach ($this->GroupsItems as $GroupsItem) {
                $Groups->service_group()->attach($GroupsItem['service_id'],['quantity' => $GroupsItem['quantity']]);
            }

            $this->reset('GroupsItems', 'name_group', 'notes');
            $this->discount_value = 0;
            $this->ServiceSaved = true;

        }

    }

    // a function make the value of the show_table false to breake the roule and view the add view
    public function show_form_add(){
        $this->show_table = false;
    }

    public function edit($id)
    {
        $this->show_table = false; // hide the table of group_servicese
        $this->updateMode = true; // now i want to upadte a table
        $group = Group::where('id',$id)->first();// get the data of the group the have the sende id 
        $this->group_id = $id; // the $id that have been sented 

        $this->reset('GroupsItems', 'name_group', 'notes');//clear this fildes 
        $this->name_group=$group->name; //get the current values
        $this->notes=$group->notes;//+
        

        $this->discount_value = intval($group->discount_value);
        $this->ServiceSaved = false; // i am in edit mode and not in add mode

        foreach ($group->service_group as $serviceGroup)
        {
            $this->GroupsItems[] = [
                'service_id' => $serviceGroup->id,
                'quantity' => $serviceGroup->pivot->quantity,
                'is_saved' => true,// all single services in the group need to confirm to bee saved
                'service_name' => $serviceGroup->name,
                'service_price' => $serviceGroup->price
            ];
        }
    }

    public function delete($id){
        Group::destroy($id);
        return redirect()->to('/Add_GroupServices');
    }
}
