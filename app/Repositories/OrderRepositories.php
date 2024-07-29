<?php

namespace App\Repository;
use App\Interfaces\OrderInterface;
use App\Models\Order;
class OrderRepository implements OrderInterface
{
    public function index(){
        return Order::all();
    }

    public function getById($id){
       return Order::findOrFail($id);
    }

    public function store(array $data){
       return Order::create($data);
    }

    public function update(array $data,$id){
       return Order::whereId($id)->update($data);
    }
    
    public function delete($id){
       Order::destroy($id);
    }
}