@section('title', 'Editar Cliente')

<x-app-layout>
    <div>
        <x-card title="Editar Cliente" backUrl="clients.index">
            <form method="POST" action="{{ route('clients.update', $client) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="name" value="Nome" />
                        <x-text-input id="name" name="name" placeholder="Nome completo" :value="$client->name" />
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ cpf: '{{ $client->cpf_formatado }}' }">
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

                    <div x-data="{ rg: '{{ $client->rg }}' }">
                        <x-input-label for="rg" value="RG" />
                        <x-text-input id="rg" name="rg" placeholder="00.000.000-0" x-model="rg"
                            x-on:input="rg = rg.replace(/\D/g, '')" maxlength="14" class="w-full" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-6">
                    <div>
                        <x-input-label for="address" value="Endereço" />
                        <x-text-input id="address" name="address" placeholder="Rua, número, bairro"
                            :value="$client->address" />
                    </div>

                    <div x-data="{ phone: '{{ $client->phone_formatado }}' }">
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
                        <x-text-input id="email" name="email" type="email" placeholder="email@exemplo.com"
                            :value="$client->email" />
                    </div>
                </div>

                <div class="mt-6">
                    <x-input-label for="notes" value="Observações" />
                    <x-textarea id="notes" name="notes" placeholder="Observações sobre o cliente...">
                        {{ $client->notes }}
                    </x-textarea>
                </div>

                <div class="mt-6 text-right">
                    <x-primary-button>Atualizar</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
