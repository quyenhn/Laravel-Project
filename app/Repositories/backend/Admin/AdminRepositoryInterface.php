<?php
namespace App\Repositories\backend\Admin;

interface  AdminRepositoryInterface
{
    public function  all();
//
//    public function  find($id);
//
    public function  save($data);
//
//    public function  update($id, $data);
//
    public function  delete($id);
//
    public function  checkIfExist($username, $email);
//
//    public function  changePassword($id, $password);
//
//    public function  resetPassword($id, $password);
//
//    public function  login($username);
}