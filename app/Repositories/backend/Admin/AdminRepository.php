<?php
namespace  App\Repositories\backend\Admin;
use App\Admin;
//use App\Repositories\backend\Admin\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function  all()
    {
        return Admin::all('id','name','email');
    }

    public function  save($data)
    {
        $admin = new Admin();
        $admin->name = $data['username'];
        $admin->email = $data['email'];
        $admin->password = bcrypt($data['password']);

        return $admin->save();
    }

    public function delete($id)
    {
        return $delete = Admin::where('id',$id)->delete();
    }

    public function checkIfExist($username, $email)
    {
        $username = Admin::where('name',$username)->get();
        $email = Admin::where('email', $email)->get();
        if (isset($username[0])){
            return 0;
        }elseif (isset($email[0])){
            return 1;
        }
        else{
            return 2;
        }
    }
}

?>