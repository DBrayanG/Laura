<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pagina;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Administrador']);
        $vendendor = Role::create(['name' => 'Vendedor']);
        $almacenista = Role::create(['name' => 'Almacenista']);
        $public = Role::create(['name' => 'Publico']);

        //Permisos
        Permission::create(['name' => 'dashboard', 'description' => 'Ver Dashboard'])->syncRoles($admin, $vendendor, $almacenista);
        Permission::create(['name' => 'usuarios', 'description' => 'Gestionar Usuarios'])->syncRoles($admin);
        Permission::create(['name' => 'roles', 'description' => 'Gestionar Roles'])->syncRoles($admin);
        Permission::create(['name' => 'pedidos', 'description' => 'Gestionar Pedidos'])->syncRoles($admin, $vendendor);
        Permission::create(['name' => 'compras', 'description' => 'Gestionar Compras'])->syncRoles($admin, $almacenista);
        Permission::create(['name' => 'proveedores', 'description' => 'Gestionar Proveedores'])->syncRoles($admin);
        Permission::create(['name' => 'ingresos', 'description' => 'Gestionar Ingresos'])->syncRoles($admin, $almacenista);
        Permission::create(['name' => 'salidas', 'description' => 'Gestionar Salidas'])->syncRoles($admin, $almacenista);
        Permission::create(['name' => 'productos', 'description' => 'Gestionar Productos'])->syncRoles($admin, $almacenista, $vendendor);
        Permission::create(['name' => 'reportes', 'description' => 'Gestionar Reportes'])->syncRoles($admin);

        //Paginas
        Pagina::create(['nombre' => 'Dashboard', 'ruta' => 'dashboard', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Usuarios', 'ruta' => 'usuario.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Usuario', 'ruta' => 'usuario.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Usuario', 'ruta' => 'usuario.edit', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Roles', 'ruta' => 'rol.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Rol', 'ruta' => 'rol.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Rol', 'ruta' => 'rol.edit', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Pedidos', 'ruta' => 'pedido.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Pedido', 'ruta' => 'pedido.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Pedido', 'ruta' => 'pedido.show', 'visitas' => 0]);

        Pagina::create(['nombre' => 'Listar Producto', 'ruta' => 'producto.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Producto', 'ruta' => 'producto.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Producto', 'ruta' => 'producto.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Producto', 'ruta' => 'producto.edit', 'visitas' => 0]);

        Pagina::create(['nombre' => 'Listar Proveedores', 'ruta' => 'proveedor.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Proveedor', 'ruta' => 'proveedor.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Proveedor', 'ruta' => 'proveedor.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Editar Proveedor', 'ruta' => 'proveedor.edit', 'visitas' => 0]);

        Pagina::create(['nombre' => 'Listar Compras', 'ruta' => 'compra.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Compra', 'ruta' => 'compra.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nueva Compra', 'ruta' => 'compra.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Compra', 'ruta' => 'compra-detalle.new', 'visitas' => 0]);

        Pagina::create(['nombre' => 'Listar Ingresos', 'ruta' => 'ingreso.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Ingreso', 'ruta' => 'ingreso.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nuevo Ingreso', 'ruta' => 'ingreso.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Ingreso', 'ruta' => 'ingreso-detalle.new', 'visitas' => 0]);

        Pagina::create(['nombre' => 'Listar Salidas', 'ruta' => 'salida.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Ver Salida', 'ruta' => 'salida.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Nueva Salida', 'ruta' => 'salida.new', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Salida', 'ruta' => 'salida-detalle.new', 'visitas' => 0]);



        // Paginas publicas
        Pagina::create(['nombre' => 'Inicio', 'ruta' => 'inicio', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Lista de Producto', 'ruta' => 'public.producto.list', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Producto', 'ruta' => 'public.producto.show', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Carrito', 'ruta' => 'public.carrito', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Confirmar Pedido', 'ruta' => 'public.confirm_pedido', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Acerca de', 'ruta' => 'public.acerca_de', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Contacto', 'ruta' => 'public.contacto', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Perfil', 'ruta' => 'public.perfil', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Lista de Pedidos', 'ruta' => 'public.pedido', 'visitas' => 0]);
        Pagina::create(['nombre' => 'Detalle de Pedido', 'ruta' => 'public.pedido.show', 'visitas' => 0]);


        //Usuarios
        User::create([
            'name' => 'Brayan',
            'email' => 'duawnbrayan@gmail.com',
            'password' => bcrypt('123456789'),
            'direccion' => 'calle falsa 123',
            'telefono' => '123456789',
            'cargo' => 'Administrador',
            'es_cliente' => true,
            'es_personal' => true,
            'es_administrador' => true,
        ])->assignRole('Administrador');
        User::create([
            'name' => 'evans',
            'email' => 'evansbalcazar@uagrm.edu.bo',
            'password' => bcrypt('123456789'),
            'direccion' => 'calle falsa 123',
            'telefono' => '123456789',
            'cargo' => 'Administrador',
            'es_cliente' => true,
            'es_personal' => true,
            'es_administrador' => true,
        ])->assignRole('Administrador');        
    }
}
