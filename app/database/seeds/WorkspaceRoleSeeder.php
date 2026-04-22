<?php

use Illuminate\Database\Seeder;
use App\WorkspaceRole;

class WorkspaceRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = WorkspaceRole::create([
            'key' => 'ADMIN',
            'name' => 'Admin'
        ]);

        $editorRole = WorkspaceRole::create([
            'key' => 'EDITOR',
            'name' => 'Editor'
        ]);

        $viewerRole = WorkspaceRole::create([
            'key' => 'VIEWER',
            'name' => 'Viewer'
        ]);
    }
}
