<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ❌ ERROR: La variable se llama $admins pero contiene TODOS los usuarios
        // ✅ SOLUCIÓN: Cambiar el nombre a $usuarios
        
        $usuarios = [ // <-- CAMBIÉ $admins por $usuarios
            [
                'name' => 'Departamento de Vinculación ITSZN',
                'email' => 'vinculacion@itszn.edu.mx',
                'password' => Hash::make('vinculacion2024'),
                'tipo' => 'admin',
                'rol_especifico' => 'vinculacion',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Coordinación de Servicio Social',
                'email' => 'servicio.social@itszn.edu.mx', 
                'password' => Hash::make('servicio2024'),
                'tipo' => 'admin',
                'rol_especifico' => 'servicio_social',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dirección ITSZN',
                'email' => 'direccion@itszn.edu.mx',
                'password' => Hash::make('direccion2024'),
                'tipo' => 'admin',
                'rol_especifico' => 'direccion',
                'email_verified_at' => now(),
            ],

            // 🏢 EMPRESA (TECNOSOFT)
            [
                'name' => 'Roberto Mendoza',
                'email' => 'contacto@technosoft.com',
                'password' => Hash::make('techno2024'),
                'tipo' => 'empresa',
                'email_verified_at' => now(),
            ],

            // 👨‍🎓 ALUMNO (ADÁN)
            [
                'name' => 'Adán Aguilar Canseco',
                'email' => 'jeada040203@gmail.com',
                'password' => Hash::make('20030402'),
                'tipo' => 'alumno',
                'numero_control' => '20231001',
                'email_verified_at' => now(),
            ]
        ];

        // ❌ ERROR: Tienes un foreach DENTRO de otro foreach
        // ✅ SOLUCIÓN: Solo UN foreach
        
        foreach ($usuarios as $usuario) {
            // Verificar si ya existe
            if (!Usuario::where('email', $usuario['email'])->exists()) {
                Usuario::create($usuario);
                
                // Mostrar info según el tipo de usuario
                if (isset($usuario['rol_especifico'])) {
                    $this->command->info("✅ Creado: {$usuario['name']} - Rol: {$usuario['rol_especifico']}");
                } else if (isset($usuario['tipo'])) {
                    $this->command->info("✅ Creado: {$usuario['name']} - Tipo: {$usuario['tipo']}");
                }
            } else {
                // Si ya existe, solo actualizar campos importantes
                $usuarioExistente = Usuario::where('email', $usuario['email'])->first();
                
                // Actualizar rol_especifico si el usuario es admin
                if (isset($usuario['rol_especifico']) && $usuario['tipo'] == 'admin') {
                    $usuarioExistente->update(['rol_especifico' => $usuario['rol_especifico']]);
                    $this->command->warn("⚠️ Actualizado: {$usuario['email']} - Nuevo rol: {$usuario['rol_especifico']}");
                }
            }
        }

        $this->command->info('🎉 ¡USUARIOS DE PRUEBA CREADOS!');
        $this->command->info('================================');
        $this->command->info('🔑 CREDENCIALES:');
        $this->command->info('   👑 Admin: vinculacion@itszn.edu.mx / vinculacion2024');
        $this->command->info('   🎓 Serv Social: servicio.social@itszn.edu.mx / servicio2024');
        $this->command->info('   🏢 Empresa: contacto@technosoft.com / techno2024');
        $this->command->info('   👨‍🎓 Alumno: jeada040203@gmail.com / 20030402');
        $this->command->info('================================');
    }
}