<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permisos:

        $permission = Permission::create(['name' => 'Ingresar usuario']);      
        $permission = Permission::create(['name' => 'Consultar usuario']);
        $permission = Permission::create(['name' => 'Actualizar usuario']);
        $permission = Permission::create(['name' => 'Eliminar usuario']);

        $permission = Permission::create(['name' => 'Ingresar médico']);
        $permission = Permission::create(['name' => 'Consultar médico']);
        $permission = Permission::create(['name' => 'Actualizar médico']);
        $permission = Permission::create(['name' => 'Eliminar médico']);

        $permission = Permission::create(['name' => 'Ingresar paciente']);
        $permission = Permission::create(['name' => 'Consultar paciente']);
        $permission = Permission::create(['name' => 'Actualizar paciente']);
        $permission = Permission::create(['name' => 'Eliminar paciente']);

        $permission = Permission::create(['name' => 'Ingresar atención']);
        $permission = Permission::create(['name' => 'Consultar atención']);
        $permission = Permission::create(['name' => 'Actualizar atención']);
        $permission = Permission::create(['name' => 'Eliminar atención']);
        
        $permission = Permission::create(['name' => 'Consultar estadísticas']);

        $permission = Permission::create(['name' => 'Administrar roles y permisos']);

        // Roles:

        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo('Ingresar usuario', 'Consultar usuario', 'Actualizar usuario', 'Eliminar usuario');
        $role->givePermissionTo('Ingresar médico', 'Consultar médico', 'Actualizar médico', 'Eliminar médico');
        $role->givePermissionTo('Ingresar paciente', 'Consultar paciente', 'Actualizar paciente', 'Eliminar paciente');
        $role->givePermissionTo('Administrar roles y permisos');

        $role = Role::create(['name' => 'Director']);
        $role->givePermissionTo('Consultar paciente', 'Consultar médico', 'Consultar atención', 'Consultar estadísticas');

        $role = Role::create(['name' => 'Secretaria']);
        $role->givePermissionTo('Ingresar atención', 'Consultar atención', 'Actualizar atención', 'Eliminar atención');
        $role->givePermissionTo('Consultar paciente', 'Consultar médico');

        $role = Role::create(['name' => 'Paciente']);
        $role->givePermissionTo('Consultar atención');

        // Usuarios:

        $user = User::create(array(
            'name' => 'Daniel Montero',
            'email' => 'administrador@hospital.com',
            'password' => bcrypt('administrador'),
        ));
        $user->assignRole('Administrador');

        $user = User::create(array(
            'name' => 'Claudio Barrios',
            'email' => 'director@hospital.com',
            'password' => bcrypt('director'),
        ));
        $user->assignRole('Director');

        $user = User::create(array(
            'name' => 'Pamela Rodríguez',
            'email' => 'secretaria@hospital.com',
            'password' => bcrypt('secretaria'),
        ));
        $user->assignRole('Secretaria');
    }
}
