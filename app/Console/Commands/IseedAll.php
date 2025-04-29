<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class IseedAll extends Command
{
    protected $signature = 'iseed:all';
    protected $description = 'Gera seeders para todas as tabelas do banco de dados, exceto tabelas de sistema.';

    public function handle()
    {
        $this->info('🔎 Buscando tabelas do banco...');

        // Pegando todas as tabelas
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        // Tabelas que vamos ignorar
        $excludedTables = [
            'migrations',
            'password_resets',
            'failed_jobs',
            'personal_access_tokens',
            'jobs',
            'job_batches'
        ];

        // Filtra as tabelas que queremos
        $tables = array_filter($tables, function ($table) use ($excludedTables) {
            return !in_array($table, $excludedTables);
        });

        if (empty($tables)) {
            $this->warn('⚠️ Nenhuma tabela encontrada para gerar seeders.');
            return;
        }

        $tablesString = implode(',', $tables);

        $this->info('⚙️ Gerando seeders para: ' . $tablesString);

        // Executa o iseed com todas as tabelas
        $this->call('iseed', [
            'tables' => $tablesString
        ]);

        $this->info('✅ Seeders gerados com sucesso!');
    }
}
