<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            'main categories'=> ['main categories create','main categories edit','main categories view','main categories delete'] ,
            'sub categories' => ['sub categories create','sub categories edit','sub categories view','sub categories delete'],
            'option products' => ['option products create','option products edit','option products view','option products delete'],
            'offers' => ['offers create','offers edit','offers view','offers delete'],
            'orders' => ['orders create','orders edit','orders view','orders delete'],
            'sales report' => ['sales report create','sales report edit','sales report view','sales report delete'],
            'discount' => ['discount create','discount edit','discount view','discount delete'],
            'coupon' => ['coupon create','coupon edit','coupon view','coupon delete'],
            'users' => ['users edit','users view'],
            'pages' => ['pages create','pages edit','pages view','pages delete'],
            'general information' => ['general information edit','general information view'],
            'branches' => ['branches create','branches edit','branches view','branches delete'],
            'settings' => ['settings create','settings edit','settings view','settings delete'],
            'delivery locations' => ['delivery locations create','delivery locations edit','delivery locations view','delivery locations delete'],
            'conditional delivery' => ['conditional delivery create','conditional delivery edit','conditional delivery view','conditional delivery delete'],
            'general settings' => ['general settings edit','general settings view'],
            'point settings' => ['point settings edit','point settings view'],
            'application gifts' => ['application gifts create','application gifts edit','application gifts view','application gifts delete'],
            'occasions' => ['occasions create','occasions edit','occasions view','occasions delete'],
            'categories occasions' => ['categories occasions create','categories occasions edit','categories occasions view','categories occasions delete'],
            'the site' => ['the site create','the site edit','the site view','the site delete'],
            'messages' => ['messages create','messages edit','messages view','messages delete'],
            'slider' => ['slider create','slider edit','slider view','slider delete'],
            'subscription mailing list' => ['subscription mailing list create','subscription mailing list edit','subscription mailing list view','subscription mailing list delete'],
            'customer data' => ['customer data create','customer data edit','customer data view','customer data delete'],
            'users admin' => ['users admin create','users admin edit','users admin view','users admin delete'],
            'technical support' => ['technical support create','technical support edit','technical support view','technical support delete'],
            'the list' => ['the list create','the list edit','the list view','the list delete'],
            'sections' => ['sections create','sections edit','sections view','sections delete'],
            'products' => ['products create','products edit','products view','products delete'],
            'operators' => ['operators create','operators edit','operators view','operators delete'],
            'regions' => ['regions create','regions edit','regions view','regions delete'],
            'products report' => ['products report create','products report edit','products report view','products report delete'],
            'menu sliders' => ['menu sliders report create','menu sliders report edit','menu sliders report view','menu sliders report delete'],
            'contact' => ['contact edit','contact view','contact delete'],
            'newsletter' => ['newsletter view','newsletter delete'],


        ];
        $permissions = collect($arrayOfPermissionNames);
        $permissions2=[];
        foreach ($permissions as $permission=>$key){

            foreach ($key as $id){
                $permissions2[]= ['name' => $id,'guard_name' =>'admin','group_name'=>$permission];
            }

        }
//        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
//            return ['name' => $permission,'guard_name' =>'admin','groupName'=>''];
//        });

        Permission::insert($permissions2);
        $role = Role::create(['name' =>'admin_1','guard_name' =>'admin'])->givePermissionTo($arrayOfPermissionNames);


    }
}
