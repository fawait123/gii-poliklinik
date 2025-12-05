<x-layout>
    <x-datatable 
                    api-url="/test-datatable-api" 
                    :columns="[
                        ['key' => 'id', 'label' => 'No'],
                        ['key' => 'name', 'label' => 'Nama Pendaftar'],
                        ['key' => 'email', 'label' => 'Email']
                    ]" 
                    :actions="true"
                    base-path="users"
                    title="Data Seleksi Pendaftar"
                    @delete="console.log('Delete item:', $event.detail)"
                />
</x-layout>
