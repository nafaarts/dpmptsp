<form method="GET" class="flex gap-2">
    <x-form.input type="search" name="cari" placeholder="Cari Sesuatu.." :value="request('cari')" />
    <x-button>
        <i class="fas fa-fw fa-search"></i>
    </x-button>
</form>
