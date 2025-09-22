<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Atualizar usuários existentes com dados de perfil de exemplo
        $users = User::all();

        $sampleProfiles = [
            [
                'bio' => 'Desenvolvedor apaixonado por tecnologia e inovação. Sempre em busca de novos desafios e oportunidades de aprendizado.',
                'phone' => '(11) 99999-1111',
                'location' => 'São Paulo, Brasil',
                'website' => 'https://github.com/usuario1',
                'birth_date' => '1990-05-15'
            ],
            [
                'bio' => 'Designer UX/UI com experiência em criar interfaces intuitivas e experiências memoráveis para usuários.',
                'phone' => '(21) 98888-2222',
                'location' => 'Rio de Janeiro, Brasil',
                'website' => 'https://portfolio.design.com',
                'birth_date' => '1992-08-22'
            ],
            [
                'bio' => 'Gerente de projetos especializada em metodologias ágeis e transformação digital.',
                'phone' => '(31) 97777-3333',
                'location' => 'Belo Horizonte, Brasil',
                'website' => 'https://linkedin.com/in/gerente',
                'birth_date' => '1988-12-03'
            ],
            [
                'bio' => 'Analista de dados com foco em machine learning e business intelligence.',
                'phone' => '(47) 96666-4444',
                'location' => 'Florianópolis, Brasil',
                'website' => 'https://datascience.blog.com',
                'birth_date' => '1994-03-18'
            ]
        ];

        foreach ($users as $index => $user) {
            $profileData = $sampleProfiles[$index % count($sampleProfiles)];

            $user->update([
                'bio' => $profileData['bio'],
                'phone' => $profileData['phone'],
                'location' => $profileData['location'],
                'website' => $profileData['website'],
                'birth_date' => $profileData['birth_date']
            ]);
        }

        $this->command->info('Perfis de usuários atualizados com dados de exemplo!');
    }
}
