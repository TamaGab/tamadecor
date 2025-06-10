@section('title', 'Cadastro Cliente')

<x-app-layout>
    <div>
        <x-custom-card title="Dados do Cliente">
            @php
                $source = url()->previous() == route('orders.create') ? 'orders' : 'clients';
            @endphp
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf

                <input type="hidden" name="source" value="{{ $source }}">

                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="name" value="Nome" />
                        <x-text-input id="name" name="name" placeholder="Nome completo" />
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ cpf: '' }">
                        <x-input-label for="cpf" value="CPF" />
                        <x-text-input id="cpf" name="cpf" placeholder="000.000.000-00" x-model="cpf"
                            x-on:input="
                                cpf = cpf.replace(/\D/g, '').slice(0,11)
                                    .replace(/(\d{3})(\d)/, '$1.$2')
                                    .replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3')
                                    .replace(/(\d{3})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3-$4')
                            "
                            class="w-full" />
                        @error('cpf')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ rg: '' }">
                        <x-input-label for="rg" value="RG" />
                        <x-text-input id="rg" name="rg" placeholder="00.000.000-0" x-model="rg"
                            x-on:input="rg = rg.replace(/\D/g, '')" maxlength="14" class="w-full" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-6">
                    <div>
                        <x-input-label for="address" value="Endereço" />
                        <x-text-input id="address" name="address" placeholder="Rua, número, bairro" />
                    </div>

                    <div x-data="{ phone: '' }">
                        <x-input-label for="phone" value="Telefone" />
                        <x-text-input id="phone" name="phone" placeholder="(00) 00000-0000" x-model="phone"
                            x-on:input="
                                phone = phone.replace(/\D/g, '').slice(0,11);
                                if (phone.length > 6) {
                                    phone = phone.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
                                } else if (phone.length > 2) {
                                    phone = phone.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
                                } else if (phone.length > 0) {
                                    phone = phone.replace(/^(\d*)/, '($1');
                                }
                            "
                            maxlength="15" class="w-full" />
                    </div>

                    <div>
                        <x-input-label for="email" value="E-mail" />
                        <x-text-input id="email" name="email" type="email" placeholder="email@exemplo.com" />
                    </div>
                </div>

                <div class="mt-6">
                    <x-input-label for="notes" value="Observações" />
                    <x-textarea id="notes" name="notes" placeholder="Observações sobre o cliente..." />
                </div>

                <div class="mt-6 text-right">
                    <x-primary-button>Salvar</x-primary-button>
                </div>
            </form>
        </x-custom-card>
    </div>
</x-app-layout>
