<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use App\Models\Contact;
use App\Models\Category;

class Admin extends Component
{
    use WithPagination;
    public $showModal = false;
    public $detailContact;
    public $name;
    public $gender;
    public $category_id;
    public $date;

    public function openModal($id)
    {
        $this->detailContact = Contact::find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function deleteData($id)
    {
        Contact::find($id)->delete();
        $this->showModal = false;
    }

    public function render()
    {
        $query = Contact::query();

        if ($this->name) {
            $query->where(function ($q) {
                $q->orWhere('first_name', 'like', '%' . $this->name . '%')
                  ->orWhere('last_name', 'like', '%' . $this->name . '%')
                  ->orWhere('email', 'like', '%' . $this->name . '%');
            });
        }

        if ($this->gender && $this->gender != 0) {
            $query->where('gender', $this->gender);
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->date) {
            $query->whereDate('created_at', $this->date);
        }

        $contacts = $query->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('livewire.admin', compact('contacts', 'categories'));
    }

    public function mount($name = null, $gender = null, $category_id = null, $date = null)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->category_id = $category_id;
        $this->date = $date;
    }
}
